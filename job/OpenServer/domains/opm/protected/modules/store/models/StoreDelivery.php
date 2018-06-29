<?php

/**
 * This is the model class for table "{{store_delivery}}".
 *
 * The followings are the available columns in table '{{store_delivery}}':
 * @property integer $id
 * @property string $name
 * @property double $us_shipping
 * @property double $int_shipping
 * @property integer $position
 */
class StoreDelivery extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return StoreDelivery the static model class
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
		return '{{store_delivery}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{

		return array(
			array('name, us_shipping, int_shipping, position', 'required'),
			array('position', 'numerical', 'integerOnly'=>true),
			array('us_shipping, int_shipping', 'numerical'),
			array('name', 'length', 'max'=>255),
			array('id, name, us_shipping, int_shipping, position', 'safe', 'on'=>'search'),
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
			'id' => Yii::t('admin', '№'),
			'name' => Yii::t('admin', 'Flat Rate Shipping'),
			'us_shipping' => Yii::t('admin', 'US Shipping'),
			'int_shipping' => Yii::t('admin', 'International Shipping'),
			'position' => Yii::t('admin', 'Position'),
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
		$criteria->compare('us_shipping',$this->us_shipping);
		$criteria->compare('int_shipping',$this->int_shipping);
		$criteria->compare('position',$this->position);

		return new CActiveDataProvider(get_class($this), array(
			'pagination'=>array(
				'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
			),
			'criteria'=>$criteria,
		));
	}
}