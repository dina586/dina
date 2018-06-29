<?php

/**
 * This is the model class for table "{{geo_usa_states}}".
 *
 * The followings are the available columns in table '{{geo_usa_states}}':
 * @property integer $id
 * @property string $state_name
 * @property string $state_abbreviation
 */
class UsaStates extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UsaStates the static model class
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
		return '{{geo_usa_states}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{

		return array(
			array('id, state_name, state_abbreviation', 'required'),
			array('id', 'numerical', 'integerOnly'=>true),
			array('state_name', 'length', 'max'=>22),
			array('state_abbreviation', 'length', 'max'=>2),
			array('id, state_name, state_abbreviation', 'safe', 'on'=>'search'),
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
			'state_name' => Yii::t('admin', 'State Name'),
			'state_abbreviation' => Yii::t('admin', 'State Abbreviation'),
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
		$criteria->compare('state_name',$this->state_name,true);
		$criteria->compare('state_abbreviation',$this->state_abbreviation,true);

		return new CActiveDataProvider(get_class($this), array(
			'pagination'=>array(
				'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
			),
			'criteria'=>$criteria,
		));
	}
}