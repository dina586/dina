<?php

/**
 * This is the model class for table "{{Sproduct}}".
 *
 * The followings are the available columns in table '{{Sproduct}}':
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $content
 * @property double $price
 * @property double $share_price
 * @property string $date
 * @property integer $position
 * @property integer $is_view
 * @property integer $in_stock
 * @property integer $catalog_id
 */
class Product extends CActiveRecord implements IECartPosition 
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Product the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public $image;
	public function tableName()
	{
		return '{{sproduct}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, content, price, new, date, popular, top_season, position, is_view, slider_view, in_stock', 'required'),
			array('share_price, url, description, articul, seo_description, seo_title, seo_keywords', 'safe'),
			array('position, is_view, in_stock', 'numerical', 'integerOnly'=>true),
			array('price, popular, share_price', 'numerical'),
			array('name', 'length', 'max'=>500),
			array('image', 'file', 
				'types'=>'jpg, gif, png, jpeg',
				'maxSize'=>1024 * 1024 * 2, 
				'allowEmpty'=>true,
				'tooLarge'=>'Файл должен быть не более 2MB'
			),
			array('url', 'unique'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, description, content, price, share_price, new, popular, date, position, is_view, in_stock, top_season, articul', 'safe', 'on'=>'search'),
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
			//'catalog'=>array(self::BELONGS_TO, 'Catalog', 'catalog_id'),
			'catalog'=>array(self::MANY_MANY, 'Catalog',
                'tbl_sconnect_prod_cat(product_id, catalog_id)'),
			'product_c'=>array(self::HAS_MANY, 'Connect', 'product_id'),
			'comment'=>array(self::HAS_MANY, 'Comment', 'product_id'),
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
			'description' => 'Краткое описание',
			'content' => 'Полное описание',
			'price' => 'Цена',
			'share_price' => 'Цена на акции',
			'date' => 'Дата',
			'new' => 'Новый товар',
			'position' => 'Позиция',
			'is_view' => 'Статус',
			'in_stock' => 'Участие в акции',
			'popular'=>'Популярные',
			'top_season'=> 'Топ сезона',
			'slider_view'=>'Отображение в слайдере',
			'image' => 'Изображение для слайдера ('.Yii::app()->controller->module->thumbnailWidth.'x'.Yii::app()->controller->module->thumbnailHeight.')',
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
		$criteria->compare('price',$this->price);
		$criteria->compare('share_price',$this->share_price);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('position',$this->position);
		$criteria->compare('is_view',$this->is_view);
		$criteria->compare('in_stock',$this->in_stock);
		$criteria->compare('new',$this->new);
		$criteria->compare('popular',$this->popular);
		$criteria->compare('top_season',$this->top_season);
		$criteria->compare('url',$this->url);
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
	public function getId(){
        return self::model()->tableName().'_'.$this->id;
    }
 
    public function getPrice(){
        if(isset($this->share_price) && $this->share_price != 0)
    		return $this->share_price;
    	else
       	 return $this->price;
    }
	public function adminSearchIsView($key){
		$isView = array('1'=>'Отображается', '0' => 'Скрыт');
		return $isView[$key];
	}
	public function adminSearchTopSeason($key){
		$isView = array('1'=>'Выводится', '0' => 'Не выводиться');
		return $isView[$key];
	}
	public function adminSearchInStock($key) {
		$InStock = array('1'=>'Учавствует', '0' => 'Нет');
		return $InStock[$key];
	}
	public function adminSearchSliderView($key) {
		$sliderView = array('1'=>'Отображается', '0' => 'Нет');
		return $sliderView[$key];
	}
	public function adminSearchNew($key) {
		$new = array('1'=>'Да', '0' => 'Нет');
		return $new[$key];
	}
	public static function sliderData(){
		$catalogData = Catalog::model()->findAll(array('order'=>'name', 'condition'=>'parent_id=:parent_id', 'params' => array(':parent_id'=> -1)));
		foreach($catalogData as $value) {
			$catalogArr[$value['id']] = $value['id'];
		}
		$catalog = implode(', ', $catalogArr);
		$data = Yii::app()->db->createCommand()
	    ->select('*')
	    ->from(self::model()->tableName())
		->join(Connect::model()->tableName(), self::model()->tableName().'.id = product_id')
	    ->order('position')
	    ->group(self::model()->tableName().'.id')
		->where('is_view = 1 AND (in_stock = 1 OR new = 1 OR popular = 1) AND catalog_id IN ('.$catalog.')')
	    ->queryAll();
		return $data;
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
	protected function afterSave() {
		$path = Yii::getPathOfAlias('webroot').DS.'upload'.DS;
		Yii::app()->cFile->createDir(0775, $path.DS.Yii::app()->controller->module->id);
		if($this->image){
			$file= $path.'temp'.DS.$this->image->name;
			$this->image->saveAs($file);
		} else 
			$file = false;
		if ($file){	
			$resizeObj = new ImageResize($file);
			$resizeObj -> resizeImage(Yii::app()->controller->module->thumbnailWidth, Yii::app()->controller->module->thumbnailHeight, 'crop');
			$resizeObj -> saveImage($path.DS.Yii::app()->controller->module->id.DS.$this->id.'.jpg', 100);
			unlink($file);
		}
		parent::afterSave();
		return true;
	}
	public static function sliderDataMain(){
		$data = Yii::app()->db->createCommand()
	    ->select('*')
	    ->from(self::model()->tableName())
	    ->order('RAND()')
	    ->where('slider_view = 1 and is_view = 1')
	    ->limit(10)
	    ->queryAll();
		return $data;
	}
}