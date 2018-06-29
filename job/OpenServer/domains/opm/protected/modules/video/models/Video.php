<?php

/**
 * This is the model class for table "{{video}}".
 *
 * The followings are the available columns in table '{{video}}':
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $content
 * @property integer $is_view
 * @property integer $position
 * @property string $video_code
 * @property string $tutorial_code
 */
class Video extends CActiveRecord
{
	const WIDTH = 270;
	const HEIGHT = 200;
	
	public $image;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Video the static model class
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
		return '{{video}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{

		return array(
			array('name, is_view, position, video_code, price', 'required'),
			array('tutorial_code, description, content', 'safe'),
			array('is_view, position', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			array('image', 'file',
				'types'=>'jpg, gif, png, jpeg',
				'maxSize'=>1024 * 1024 * 3,
				'allowEmpty'=>true,
				'tooLarge'=>Yii::t('admin', 'File size should not exceed').' 3 MB',
			),
			array('id, name, description, content, is_view, position, video_code, tutorial_code', 'safe', 'on'=>'search'),
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
	
	public function behaviors(){
		return array(
			'cacheBehavior' =>array(
				'class' => 'application.components.behavior.CacheBehavior',
			),
			'imageBehavior' => array(
				'class' => 'application.components.behavior.ImageBehavior',
				'data'=>array(
					'image'=>array(
						'width'=> self::WIDTH,
						'height'=> self::HEIGHT,
						'folder'=> Yii::app()->getModule('video')->folder,
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
			'id' => Yii::t('admin', 'ID'),
			'name' => Yii::t('admin', 'Name'),
			'description' => Yii::t('admin', 'Description'),
			'content' => Yii::t('admin', 'Content'),
			'is_view' => Yii::t('admin', 'Is View'),
			'position' => Yii::t('admin', 'Position'),
			'price' => 'Price',
			'video_code' => Yii::t('admin', 'Video Code'),
			'tutorial_code' => Yii::t('admin', 'Tutorial Video Code'),
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
		$criteria->compare('description',$this->description,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('is_view',$this->is_view);
		$criteria->compare('price',$this->price);
		$criteria->compare('position',$this->position);


		return new CActiveDataProvider(get_class($this), array(
			'pagination'=>array(
				'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
			),
			'criteria'=>$criteria,
		));
	}
	
	protected function beforeValidate() {
		print_r($_POST);
		die();
		parent::beforeValidate();
		return true;
	}
}