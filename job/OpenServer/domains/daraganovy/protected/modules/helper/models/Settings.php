<?php

/**
 * This is the model class for table "{{settings}}".
 *
 * The followings are the available columns in table '{{settings}}':
 * @property integer $id
 * @property string $name
 * @property string $value
 * @property string $base_key
 * @property string $comment
 */
class Settings extends CActiveRecord
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
		return '{{settings}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{

		return array(
			array('name, base_key, element, module_id, visible', 'required'),
			array('comment, value', 'safe'),
			array('base_key', 'unique'),
			array('name, base_key', 'length', 'max'=>255),
			array('id, name, value, base_key, comment, element, module_id', 'safe', 'on'=>'search'),
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
			'name' => Yii::t('admin', 'Name'),
			'value' => Yii::t('admin', 'Value'),
			'base_key' => Yii::t('admin', 'System key'),
			'module_id' => Yii::t('admin', 'Module Name'),
			'element' => Yii::t('admin', 'Value field element type'),
			'visible' => Yii::t('admin', 'The role of the user who can see this setting'),
			'comment' => Yii::t('admin', 'Comment'),
		);
	}
	
	public function behaviors() {
		return array(
			'cacheBehavior' =>array(
				'class' => 'application.components.behavior.CacheBehavior',
				'column'=>'base_key',
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
		$criteria->compare('module_id',$this->module_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('value',$this->value,true);
		$criteria->compare('base_key',$this->base_key,true);
		$criteria->compare('element',$this->element,true);
		$criteria->compare('comment',$this->comment,true);
		
		if(!Yii::app()->user->checkAccess("developer"))
			$criteria->compare('visible','admin',true);
		
		return new CActiveDataProvider(get_class($this), array(
			'pagination'=>array(
				'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
			),
			'sort'=>array(
				'defaultOrder'=>'module_id, id',	
			),
			'criteria'=>$criteria,
		));
	}
	
	public static function getVal($name) {
		$settings = System::loadModel('Settings', null, $name, 'base_key');
		return Yii::t('admin', $settings->value);
	}
}