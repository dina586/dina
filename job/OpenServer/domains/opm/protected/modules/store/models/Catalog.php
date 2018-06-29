<?php

/**
 * This is the model class for table "{{catalog}}".
 *
 * The followings are the available columns in table '{{catalog}}':
 * @property integer $id
 * @property string $name
 * @property integer $parent_id
 * @property integer $position
 * @property string $url
 * @property string $seo_description
 * @property string $seo_keywords
 */
class Catalog extends CActiveRecord
{
	const WIDTH = 183;
	const HEIGHT = 136;
	
	public $image;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Catalog the static model class
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
		return '{{catalog}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, parent_id, position, is_view', 'required'),
			array('url, seo_title, seo_description, seo_keywords, content', 'safe'),
			array('parent_id, position', 'numerical', 'integerOnly'=>true),
			array('name, url, seo_title', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, parent_id, position, url, seo_description, seo_keywords, is_view', 'safe', 'on'=>'search'),
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
			'product'=>array(self::MANY_MANY, 'Product',
                'tbl_prod_cat(catalog_id, product_id)',
				 'condition' => 'is_view = 1'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => '№',
			'name' => Yii::t('admin','Name'),
			'parent_id' => Yii::t('shop','Parent Catalog'),
			'content' => Yii::t('shop', 'Complete description'),
			'position' => Yii::t('admin','Position'),
			'url' => Yii::t('admin', 'Page Url'),
			'seo_title' => Yii::t('admin', 'SEO Page Title'),
			'seo_description' => Yii::t('admin', 'SEO Page Description'),
			'seo_keywords' => Yii::t('admin','SEO Page Keywords'),
			'is_view' => Yii::t('main', 'Is view'),
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
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('position',$this->position);
		$criteria->compare('is_view',$this->is_view);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('seo_title',$this->seo_title,true);
		$criteria->compare('seo_description',$this->seo_description,true);
		$criteria->compare('seo_keywords',$this->seo_keywords,true);

		return new CActiveDataProvider(get_class($this), array(
			'pagination'=>array(
				'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
			),
			'criteria'=>$criteria,
		));
	}
	
	public function behaviors(){
		return array(
			'imageBehavior' => array(
				'class' => 'application.components.behavior.ImageBehavior',
				'data'=>array(
					'image'=>array(
						'width'=> self::WIDTH,
						'height'=> self::HEIGHT,
						'folder'=> Yii::app()->getModule('store')->catalogFolder,
						'type'=>'auto',
					),
				),
			),
			'cacheBehavior' =>array(
				'class' => 'application.components.behavior.CacheBehavior',
				'tagPrefix'=>'store_',
				'tags'=>array('catalog_render'),
			),
			'seoBehavior' =>array(
				'class' => 'application.components.behavior.SeoBehavior',
			),
		);
	}
	
	public function afterDelete() {
		Connect::model()->deleteAll('catalog_id=:catalog_id', array(':catalog_id' => $this->id));
		parent::afterDelete();
		return true;
	}
	
}