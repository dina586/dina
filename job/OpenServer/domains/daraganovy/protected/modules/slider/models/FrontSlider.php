<?php

/**
 * This is the model class for table "{{front_slider}}".
 *
 * The followings are the available columns in table '{{front_slider}}':
 * @property integer $id
 * @property string $name
 * @property integer $position
 */
 
 
class FrontSlider extends CActiveRecord
{
	const WIDTH = 1500;
	const HEIGHT = 1000;
	
	public $image;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return FrontSlider the static model class
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
		return '{{front_slider}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{

		return array(
			array('name, position,content', 'required'),
			array('position', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			array('id, name, position', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function behaviors(){
		return array(
			'imageBehavior' => array(
				'class' => 'application.modules.file.components.ImageBehavior',
				'data'=>array(
					'image'=>array(
						'width'=> self::WIDTH,
						'height'=> self::HEIGHT,
						'folder'=> Yii::app()->getModule('slider')->frontFolder,
					),
				),
			),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => Yii::t('admin', '№'),
			'name' => Yii::t('admin', 'Name'),
			'position' => Yii::t('admin', 'Position'),
			'content' => Yii::t('admin', 'Content'),
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
		$criteria->compare('position',$this->position);

		return new CActiveDataProvider(get_class($this), array(
			'pagination'=>array(
				'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
			),
			'criteria'=>$criteria,
		));
	}
}