<?php

/**
 * This is the model class for table "{{geo_city}}".
 *
 * The followings are the available columns in table '{{geo_city}}':
 * @property string $id
 * @property integer $id_country
 * @property string $oid
 * @property string $city_name_ru
 * @property string $city_name_en
 */
class City extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return City the static model class
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
		return '{{geo_city}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{

		return array(
			array('id_country, oid, city_name_en', 'required'),
			array('id_country', 'numerical', 'integerOnly'=>true),
			array('oid', 'length', 'max'=>10),
			array('city_name_ru, city_name_en', 'length', 'max'=>255),
			array('id, id_country, oid, city_name_ru, city_name_en', 'safe', 'on'=>'search'),
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
			'id_country' => Yii::t('admin', 'Id Country'),
			'oid' => Yii::t('admin', 'Oid'),
			'city_name_ru' => Yii::t('admin', 'City Name Ru'),
			'city_name_en' => Yii::t('admin', 'City Name En'),
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

		$criteria->compare('id',$this->id,true);
		$criteria->compare('id_country',$this->id_country);
		$criteria->compare('oid',$this->oid,true);
		$criteria->compare('city_name_ru',$this->city_name_ru,true);
		$criteria->compare('city_name_en',$this->city_name_en,true);

		return new CActiveDataProvider(get_class($this), array(
			'pagination'=>array(
				'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
			),
			'criteria'=>$criteria,
		));
	}
}