<?php

/**
 * This is the model class for table "{{service_procedure}}".
 *
 * The followings are the available columns in table '{{service_procedure}}':
 * @property integer $id
 * @property string $name
 * @property integer $days
 * @property integer $number
 * @property integer $is_required
 */
class ServiceProcedure extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return ServiceProcedure the static model class
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
		return '{{service_procedure}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{

		return array(
			array('name, days, number, is_required, service_id, price, procedure_length', 'required'),
			array('days, number, is_required, service_id', 'numerical', 'integerOnly'=>true),
			array('price', 'numerical'),
			array('name', 'length', 'max'=>255),
			array('id, name, days, number, is_required', 'safe', 'on'=>'search'),
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
			'service'=>array(self::BELONGS_TO, 'Service', 'service_id'),
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
			'days' => Yii::t('admin', 'Days'),
			'number' => Yii::t('admin', 'Procedure Number'),
			'service_id'=>'Service',
			'price'=>'Price',
			'procedure_length'=>'Procedure length (minutes)',
			'is_required' => Yii::t('admin', 'Is Required'),
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
		$criteria->compare('days',$this->days);
		$criteria->compare('number',$this->number);
		$criteria->compare('price',$this->price);
		$criteria->compare('service_id',$this->service_id);
		$criteria->compare('is_required',$this->is_required);
		
		return new CActiveDataProvider(get_class($this), array(
			'pagination'=>array(
				'pageSize'=> Yii::app()->user->getState('pageSize', 50),
			),
			'criteria'=>$criteria,
			'sort'=>array(
				'defaultOrder'=>'service_id ASC, name ASC',
			),
		));
	}
}