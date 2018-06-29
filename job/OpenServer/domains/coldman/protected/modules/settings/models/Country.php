<?php

/**
 * This is the model class for table "{{geo_country}}".
 *
 * The followings are the available columns in table '{{geo_country}}':
 * @property integer $id
 * @property string $oid
 * @property string $country_name_ru
 * @property string $country_name_en
 */
class Country extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Country the static model class
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
		return '{{geo_country}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{

		return array(
			array('oid, country_name_ru, country_name_en', 'required'),
			array('oid', 'length', 'max'=>10),
			array('country_name_ru, country_name_en', 'length', 'max'=>50),
			array('id, oid, country_name_ru, country_name_en', 'safe', 'on'=>'search'),
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
			'oid' => Yii::t('admin', 'Oid'),
			'country_name_ru' => Yii::t('admin', 'Country Name Ru'),
			'country_name_en' => Yii::t('admin', 'Country Name En'),
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
		$criteria->compare('oid',$this->oid,true);
		$criteria->compare('country_name_ru',$this->country_name_ru,true);
		$criteria->compare('country_name_en',$this->country_name_en,true);

		return new CActiveDataProvider(get_class($this), array(
			'pagination'=>array(
				'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
			),
			'criteria'=>$criteria,
		));
	}
}