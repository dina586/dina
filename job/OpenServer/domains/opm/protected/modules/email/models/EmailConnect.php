<?php

/**
 * This is the model class for table "{{email_tag_connect}}".
 *
 * The followings are the available columns in table '{{email_tag_connect}}':
 * @property integer $id
 * @property integer $email_id
 * @property integer $tag_id
 */
class EmailConnect extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return EmailConnect the static model class
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
		return '{{email_tag_connect}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{

		return array(
			array('email_id, tag_id', 'required'),
			array('email_id, tag_id', 'numerical', 'integerOnly'=>true),
			array('id, email_id, tag_id', 'safe', 'on'=>'search'),
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
			'email_message'=>array(self::BELONGS_TO, 'EmailMessage', 'email_id'),
			'email_tag'=>array(self::BELONGS_TO, 'EmailTags', 'tag_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('admin', 'ID'),
			'email_id' => Yii::t('admin', 'Email'),
			'tag_id' => Yii::t('admin', 'Tag'),
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
		$criteria->compare('email_id',$this->email_id);
		$criteria->compare('tag_id',$this->tag_id);

		return new CActiveDataProvider(get_class($this), array(
			'pagination'=>array(
				'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
			),
			'criteria'=>$criteria,
		));
	}
}