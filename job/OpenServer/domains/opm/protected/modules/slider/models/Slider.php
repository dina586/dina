<?php

/**
 * This is the model class for table "{{stock}}".
 *
 * The followings are the available columns in table '{{stock}}':
 * @property integer $id
 * @property string $name
 * @property string $content
 * @property string $url
 * @property string $link
 * @property integer $is_view
 * @property integer $position
 * @property string $seo_title
 * @property string $seo_description
 * @property string $seo_keywords
 */
class Slider extends CActiveRecord
{
	const WIDTH = 245;
	const HEIGHT = 150;
	
	public $image;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Stock the static model class
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
		return '{{slider}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{

		return array(
			array('name, is_view, position', 'required'),
			array('is_view, position', 'numerical', 'integerOnly'=>true),
			array('name, link', 'length', 'max'=>255),
			array('link', 'safe'),
			array('is_view', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>255),
			array('image', 'file',
				'types'=>'jpg, gif, png, jpeg',
				'maxSize'=>1024 * 1024 * 3,
				'allowEmpty'=>true,
				'tooLarge'=>Yii::t('admin', 'File size should not exceed').' 3 MB',
			),
			array('id, name, content, url, link, is_view, position, seo_title, seo_description, seo_keywords', 'safe', 'on'=>'search'),
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
			'imageBehavior' => array(
				'class' => 'application.components.behavior.ImageBehavior',
				'data'=>array(
					'image'=>array(
						'width'=> self::WIDTH,
						'height'=> self::HEIGHT,
						'folder'=> Yii::app()->getModule('slider')->folder,
					),
				),
			),
			'cacheBehavior' =>array(
				'class' => 'application.components.behavior.CacheBehavior',
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
			'name' => Yii::t('admin', 'Name'),
			'position' => Yii::t('admin', 'Position'),
			'content' => Yii::t('admin', 'Content'),
			'date' => Yii::t('main', 'Date'),
			'is_view' => Yii::t('main', 'Is view'),
			'link' => Yii::t('main', 'Link'),
			'url' => Yii::t('admin', 'Page Url'),
			'seo_title' => Yii::t('admin', 'Page Title'),
			'seo_description' => Yii::t('admin', 'Page description'),
			'seo_keywords' => Yii::t('admin','Page keywords'),
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
		$criteria->compare('link',$this->link,true);
		$criteria->compare('is_view',$this->is_view);
		$criteria->compare('position',$this->position);
		

		return new CActiveDataProvider(get_class($this), array(
			'pagination'=>array(
				'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
			),
			'criteria'=>$criteria,
		));
	}
}