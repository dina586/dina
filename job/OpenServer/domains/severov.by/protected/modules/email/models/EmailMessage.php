<?php

class EmailMessage extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Settings the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{email_message}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{

		return array(
			array('name, subject, email_key, email_type, header, footer', 'required'),
			array('comment, message, success_message, failed_message', 'safe'),
			array('email_key', 'unique'),
			array('name, email_key', 'length', 'max'=>255),
			array('id, name, subject, email_key, email_type, header, footer', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'tags'=>array(self::MANY_MANY, 'EmailTags', EmailConnect::model()->tableName().'(email_id, tag_id)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => '№',
			'name' => Yii::t('admin', 'Name'),
			'subject' => Yii::t('admin', 'Email Subject'),
			'message' => Yii::t('admin', 'Email Message'),
			'email_key' => Yii::t('admin', 'System key'),
			'comment' => Yii::t('admin', 'Comment'),
			'email_type' => Yii::t('admin', 'Email For'),
			'header' => Yii::t('admin', 'Email Header'),
			'footer' => Yii::t('admin', 'Email Footer'),
			'success_message' => Yii::t('admin', 'Success message'),
			'failed_message' => Yii::t('admin', 'Failed message'),
		);
	}

	
	public function behaviors() {
		return array(
			'cacheBehavior' =>array(
				'class' => 'application.components.behavior.CacheBehavior',
				'column'=>'email_key',
			),
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('subject',$this->subject,true);
		$criteria->compare('message',$this->message,true);
		$criteria->compare('email_key',$this->email_key,true);
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('email_type',$this->email_type);
		
		return new CActiveDataProvider(get_class($this), array(
			'pagination'=>array(
				'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
			),
			'sort'=>array(
				'defaultOrder'=>'id',	
			),
			'criteria'=>$criteria,
		));
	}
	
	public function afterSave() {
		if(isset($_POST['EmailTags'])) {
			if(!$this->isNewRecord)
				self::deleteFromConnect($_POST['EmailTags'], $this->id);
			self::insertIntoConnect($_POST['EmailTags'], $this->id);
		}
		parent::afterSave();
		return true;
	}
	
	public function afterDelete() {
		EmailConnect::model()->deleteAll('email_id=:email_id', array(':email_id' => $this->id));
		parent::afterDelete();
		return true;
	}
	
	public static function getMessage($name) {
		$settings = System::loadModel('EmailMessage', null, $name, 'email_key');
		return Yii::t('admin', $settings->value);
	}
	
	/**
	 * Добавление записей в таблицу - связку
	 * @param array $tagsArray
	 * @param int $emailId
	 */
	public static function insertIntoConnect($tagsArray, $emailId) {
		$transaction = Yii::app()->db->beginTransaction();
		try {
			if(count($tagsArray)>0) {
				foreach($tagsArray as $v) {
					$count = EmailConnect::model()->count('email_id=:email_id AND tag_id=:tag_id', array(':tag_id'=>$v, ':email_id'=>$emailId));
					if($count != 0){
						continue;
					}
					else {
						$model = new EmailConnect();
						$model->tag_id = $v;
						$model->email_id = $emailId;
						$model->save();
					}
				}
			}
			$transaction->commit();
			 
		} catch (Exception $e) {
			$transaction->rollback();
			echo $e->message;
		}
	}
	
	/**
	 * Удаление записей из таблицы - связки
	 * @param array $tagsArray
	 * @param int $emailId
	 */
	public static function deleteFromConnect($tagsArray, $emailId) {
		$criteria = new CDbCriteria();
		$criteria->addNotInCondition("tag_id", $tagsArray);
		$criteria->compare('email_id', $emailId);
		EmailConnect::model()->deleteAll($criteria);
	}
}