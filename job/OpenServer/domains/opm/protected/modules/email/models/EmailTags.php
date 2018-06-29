<?php

/**
 * This is the model class for table "{{email_tags}}".
 *
 * The followings are the available columns in table '{{email_tags}}':
 * @property integer $id
 * @property string $name
 * @property string $tag
 * @property integer $tag_type
 */
class EmailTags extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return EmailTags the static model class
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
		return '{{email_tags}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{

		return array(
			array('name, tag, tag_type', 'required'),
			array('tag', 'unique'),
			array('tag_type', 'numerical', 'integerOnly'=>true),
			array('name, tag', 'length', 'max'=>255),
			array('id, name, tag, tag_type', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => '№',
			'name' => Yii::t('admin', 'Tag name'),
			'tag' => Yii::t('admin', 'Tag code'),
			'tag_type' => Yii::t('admin', 'Tag type'),
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
		$criteria->compare('tag',$this->tag,true);
		$criteria->compare('tag_type',$this->tag_type);

		return new CActiveDataProvider(get_class($this), array(
			'pagination'=>array(
				'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
			),
			'criteria'=>$criteria,
		));
	}
	
	public function beforeSave() {
		$this->tag = strtoupper($this->tag);
		parent::beforeSave();
		return true;
	}
	
	public function afterDelete() {
		EmailConnect::model()->deleteAll('tag_id=:tag_id', array(':tag_id' => $this->id));
		parent::afterDelete();
		return true;
	}
}