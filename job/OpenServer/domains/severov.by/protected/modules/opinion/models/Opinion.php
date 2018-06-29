<?php

/**
 * This is the model class for table "{{news}}".
 *
 * The followings are the available columns in table '{{news}}':
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $content
 * @property string $date
 * @property integer $is_view
 * @property string $url
 * @property string $seo_title
 * @property string $seo_description
 * @property string $seo_keywords
 */
class Opinion extends CActiveRecord
{
	
	const WIDTH = 155;
	const HEIGHT = 155;
	
	public $image;
	public $verifyCode;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return News the static model class
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
		return '{{opinion}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{

		$rules = array(
			array('content, is_view, is_new, name, view_on_main', 'required'),
			array('create_date, name', 'safe'),
			array('is_view', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			array('image', 'file',
				'types'=>'jpg, gif, png, jpeg',
				'maxSize'=>1024 * 1024 * 3,
				'allowEmpty'=>true,
				'tooLarge'=>Yii::t('admin', 'File size should not exceed').' 3 MB',
			),
			array('verifyCode', 'CaptchaExtendedValidator', 'allowEmpty'=>!CCaptcha::checkRequirements() || !extension_loaded('gd'), 'on'=>'user_form'),
		);
		
		array('verifyCode', 'CaptchaExtendedValidator', 'allowEmpty'=>!CCaptcha::checkRequirements() || !extension_loaded('gd'), 'on'=>'user_form');
		
		return $rules;
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
	
	public function behaviors(){
		return array(
			'imageBehavior' => array(
				'class' => 'application.components.behavior.ImageBehavior',
				'data'=>array(
					'image'=>array(
						'width'=> self::WIDTH,
						'height'=> self::HEIGHT,
						'folder'=> Yii::app()->getModule('opinion')->folder,
					),
				),
			),
			'dateBehavior' =>array(
				'class' => 'application.components.behavior.DateBehavior',
				'date'=> array('create_date'),
			),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => '№',
			'name' => Yii::t('admin', 'Имя'),
			'position' => Yii::t('admin', 'Позиция'),
			'content' => Yii::t('admin', 'Отзыв'),
			'is_view' => Yii::t('main', 'Is view'),
			'is_new' => Yii::t('main', 'Новый'),
			'view_on_main'=> Yii::t('main', 'Выводиться на главной'),
			'create_date' => Yii::t('main', 'Дата добавления'),
			'verifyCode' => Yii::t('main', 'Код проверки'),
			'image'=>Yii::t('admin', 'Image size in pixels').' '.self::WIDTH.'x'.self::HEIGHT,
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
		$criteria->compare('content',$this->content,true);
		$criteria->compare('is_view',$this->is_view);
		$criteria->compare('is_new',$this->is_new);
		$criteria->compare('view_on_main',$this->view_on_main);
		$criteria->compare('create_date',$this->create_date);

		return new CActiveDataProvider(get_class($this), array(
			'pagination'=>array(
				'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
			),
			'sort'=>array(
				'defaultOrder'=>'create_date ASC, id DESC',	
			),
			'criteria'=>$criteria,
		));
	}
	
	public function beforeSave(){
		
		parent::beforeSave();
		return true;
	}
}