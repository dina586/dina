<?php

/**
 * This is the model class for table "{{Scatalog}}".
 *
 * The followings are the available columns in table '{{Scatalog}}':
 * @property integer $id
 * @property string $name
 * @property integer $position
 */
class Catalog extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Catalog the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public $image;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{scatalog}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, view_on_main', 'required'),
			array('parent_id, position, seo_description, seo_title, seo_keywords, content, url', 'safe'),
			array('parent_id, position', 'numerical', 'integerOnly'=>true),
			array('name, url', 'length', 'max'=>255),
			array('position', 'length', 'max'=>11),
			array('parent_id', 'length', 'max'=>100),
			array('image', 'file', 
				'types'=>'jpg, gif, png, jpeg',
				'maxSize'=>1024 * 1024 * 2, 
				'allowEmpty'=>true,
				'tooLarge'=>'Файл должен быть не более 2MB'
			),
			array('url', 'unique'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, position, parent_id', 'safe', 'on'=>'search'),
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
                'tbl_sconnect_prod_cat(catalog_id, product_id)',
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
			'name' => 'Название',
			'parent_id' => 'Каталог-родитель',
			'position'=>'Позиция',
			'content'=>'Текст',
			'view_on_main'=>'Вывод на главную',
			'image' => 'Изображение для слайдера '.Yii::app()->controller->module->catalogWidth.'x'.Yii::app()->controller->module->catalogHeight.'',
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
		$criteria->compare('url',$this->url);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	

	public function getCatalogById($parentId) {
		$data = Yii::app()->db->createCommand()
	    ->select('*')
	    ->from(self::tableName())
	    ->order('id')
	    ->where('parent_id=:parent_id', array(':parent_id'=>$parentId))
	    ->queryAll();
		return $data;
	}
	
	public static function catalogList() {
		$list = CHtml::listData(self::model()->findAll(array('order' => 'name')), 'id', 'name');
		return $list;
	}
	protected function afterSave() {
		$path = Yii::getPathOfAlias('webroot').DS.'upload'.DS;
		Yii::app()->cFile->createDir(0775, $path.DS.'catalog');
		if($this->image){
			$file= $path.'temp'.DS.$this->image->name;
			$this->image->saveAs($file);
		} else 
			$file = false;
		if ($file){	
			$resizeObj = new ImageResize($file);
			$resizeObj -> resizeImage(Yii::app()->controller->module->catalogWidth, Yii::app()->controller->module->catalogHeight, 'crop');
			$resizeObj -> saveImage($path.DS.'catalog'.DS.$this->id.'.jpg', 100);
			unlink($file);
		}
		parent::afterSave();
		return true;
	}
	
	protected function beforeValidate() {
		if(parent::beforeValidate()) {
			/*Подготавливаем url для добавления в базу данных*/
			if($this->isNewRecord)
				$id = false;
			else
				$id = $this->id;
			$this->url = System::prepairUrl($this->url, $this->name, __CLASS__, $id);
			return true;
		}
		else
			return false;
	}
}