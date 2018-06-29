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
class Trade extends CActiveRecord
{
	
	const WIDTH = 270;
	const HEIGHT = 200;
	
	public $image;
	
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
		return '{{trade}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{

		return array(
			array('name, description, content, date, is_view', 'required'),
			array('url, seo_description, seo_keywords, seo_title', 'safe'),
			array('is_view', 'numerical', 'integerOnly'=>true),
			array('name, url, seo_title', 'length', 'max'=>255),
			array('image', 'file',
				'types'=>'jpg, gif, png, jpeg',
				'maxSize'=>1024 * 1024 * 3,
				'allowEmpty'=>true,
				'tooLarge'=>Yii::t('admin', 'File size should not exceed').' 3 MB',
			),
			array('id, name, description, content, date, is_view, url, seo_title, seo_description, seo_keywords', 'safe', 'on'=>'search'),
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
						'folder'=> Yii::app()->getModule('trade')->folder,
					),
				),
			),
			'cacheBehavior' =>array(
				'class' => 'application.components.behavior.CacheBehavior',
			),
			'seoBehavior' =>array(
				'class' => 'application.components.behavior.SeoBehavior',
			),
			'dateBehavior' =>array(
				'class' => 'application.components.behavior.DateBehavior',
				'date'=> array('date'),
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
			'description' => Yii::t('admin', 'Description'),
			'content' => Yii::t('admin', 'Content'),
			'date' => Yii::t('main', 'Date'),
			'is_view' => Yii::t('main', 'Is view'),
			'url' => Yii::t('admin', 'Page Url'),
			'seo_title' => Yii::t('admin', 'SEO Page Title'),
			'seo_description' => Yii::t('admin', 'SEO Page Description'),
			'seo_keywords' => Yii::t('admin','SEO Page Keywords'),
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
		$criteria->compare('description',$this->description,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('is_view',$this->is_view);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('seo_title',$this->seo_title,true);
		$criteria->compare('seo_description',$this->seo_description,true);
		$criteria->compare('seo_keywords',$this->seo_keywords,true);

		return new CActiveDataProvider(get_class($this), array(
			'pagination'=>array(
				'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
			),
			'sort'=>array(
				'defaultOrder'=>'date DESC',	
			),
			'criteria'=>$criteria,
		));
	}
	
	protected function beforeValidate() {
		if(parent::beforeValidate()) {
			$this->description = nl2br($this->description);
			return true;
		}
		else
			return false;
	}
}