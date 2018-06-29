<?php

/**
 * This is the model class for table "{{user_type}}".
 *
 * The followings are the available columns in table '{{user_type}}':
 * @property integer $id
 * @property integer $user_id
 * @property integer $type_id
 */
class UserType extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UserType the static model class
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
		return '{{user_type}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{

		return array(
			array('user_id, type_id', 'required'),
			array('user_id, type_id', 'numerical', 'integerOnly'=>true),
			array('id, user_id, type_id', 'safe', 'on'=>'search'),
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
			'id' => Yii::t('admin', 'ID'),
			'user_id' => Yii::t('admin', 'User'),
			'type_id' => Yii::t('admin', 'Type'),
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('type_id',$this->type_id);

		return new CActiveDataProvider(get_class($this), array(
			'pagination'=>array(
				'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
			),
			'criteria'=>$criteria,
		));
	}
	
	public static function getUserTypes($userId) {
		$current = self::model()->findAll('user_id=:user_id', array('user_id'=>$userId));
		$checked = array();
		if(count($current) >0)
			foreach($current as $v) {
			$checked[$v->type_id] = $v->type_id;
		}
		return $checked;
	}
	
	public static function requestTypes($types) {
		$data = array();
		if(count($types)>0)
			foreach($types as $k=>$v) {
				$data[$k] = $k;
			}
		return $data;
	}

}