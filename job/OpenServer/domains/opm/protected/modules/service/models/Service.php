<?php

/**
 * This is the model class for table "{{service}}".
 *
 * The followings are the available columns in table '{{service}}':
 * @property integer $id
 * @property string $name
 * @property string $content
 * @property string $url
 * @property string $seo_title
 * @property string $seo_description
 * @property string $seo_keywords
 * @property integer $is_view
 * @property integer $position
 */
class Service extends CActiveRecord
{
	const WIDTH = 270;
	const HEIGHT = 200;
	
	public $image;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Service the static model class
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
		return '{{service}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{

		return array(
			array('name, url, contract', 'required'),
			array('content, seo_title, seo_description, seo_keywords, site_name, view_on_site, description, site_content', 'safe'),
			array('is_view, position', 'numerical', 'integerOnly'=>true),
			array('name, url, seo_title', 'length', 'max'=>255),
			array('image', 'file',
				'types'=>'jpg, gif, png, jpeg',
				'maxSize'=>1024 * 1024 * 3,
				'allowEmpty'=>true,
				'tooLarge'=>Yii::t('admin', 'File size should not exceed').' 3 MB',
			),
			array('id, name, content, url, seo_title, seo_description, seo_keywords, is_view, position', 'safe', 'on'=>'search'),
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
			'name' => Yii::t('admin', 'Name'),
			'content' => Yii::t('admin', 'Content'),
			'url' => Yii::t('admin', 'Url'),
			'seo_title' => Yii::t('admin', 'Seo Title'),
			'seo_description' => Yii::t('admin', 'Seo Description'),
			'seo_keywords' => Yii::t('admin', 'Seo Keywords'),
			'is_view' => Yii::t('admin', 'Is View'),
			'position' => Yii::t('admin', 'Position'),
			'view_on_site'=>'View On Site',
			'site_name'=>'Visible site name',
			'site_content'=>'CONTENT VIEW ON SITE!',
			'description'=>'Description',
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
					'folder'=> Yii::app()->getModule('service')->folder,
					),
				),
			),
			'seoBehavior' =>array(
				'class' => 'application.components.behavior.SeoBehavior',
			),
			'cacheBehavior' =>array(
				'class' => 'application.components.behavior.CacheBehavior',
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
		$criteria->compare('contract',$this->contract);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('seo_title',$this->seo_title,true);
		$criteria->compare('seo_description',$this->seo_description,true);
		$criteria->compare('seo_keywords',$this->seo_keywords,true);
		$criteria->compare('is_view',$this->is_view);
		$criteria->compare('view_on_site',$this->view_on_site);
		$criteria->compare('position',$this->position);

		return new CActiveDataProvider(get_class($this), array(
			'pagination'=>array(
				'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
			),
			'criteria'=>$criteria,
		));
	}
	
	public function beforeSave() {
		$this->description = nl2br($this->description);
		parent::beforeSave();
		return true;
	}
	
}