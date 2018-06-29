<?php

class UserRegType extends CActiveRecord
{

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{user_registration_type}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{

		return array(
			array('name, group_id, position', 'required'),
			array('email_template', 'safe'),
			array('group_id', 'numerical', 'integerOnly'=>true),
			array('name, email_template', 'length', 'max'=>255),
			array('id, name, email_template, group_id', 'safe', 'on'=>'search'),
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
			'group'=>array(self::BELONGS_TO, 'UserGroup', 'group_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('admin', 'ID'),
			'name' => Yii::t('admin', 'Name'),
			'email_template' => Yii::t('admin', 'Email Template'),
			'group_id' => Yii::t('admin', 'Group'),
			'position'=>'Position',
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
		$criteria->compare('email_template',$this->email_template,true);
		$criteria->compare('group_id',$this->group_id);

		return new CActiveDataProvider(get_class($this), array(
			'pagination'=>array(
				'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
			),
			'criteria'=>$criteria,
		));
	}
	
	protected function afterDetele() {
		UserType::model()->deleteAll('type_id=:type_id', array(':type_id'=>$this->id));
		parent::afterDelete();
		return true;
	}
	
	
}