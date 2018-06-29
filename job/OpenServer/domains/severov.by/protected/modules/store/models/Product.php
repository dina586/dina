<?php
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
	public function tableName()
	{
		return '{{product}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('name, price, date, position, is_view, popular, is_new, stock, status', 'required'),
			array('description, content, articul, share_price, url, seo_title, seo_description, seo_keywords, ext','safe'),
			array('position, is_view, popular, is_new, stock, status', 'numerical', 'integerOnly'=>true),
			array('price, share_price', 'numerical'),
			array('price, share_price', 'type', 'type'=>'float'),
			//array('url', 'unique'),
			array('name, articul, url, seo_title', 'length', 'max'=>255),
			array('id, name, description, content, articul, price, share_price, date, position, is_view, popular, is_new, stock, status, url, seo_title, seo_description, seo_keywords', 'safe', 'on'=>'search'),
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
			'catalog'=>array(self::MANY_MANY, 'Catalog',
                'tbl_prod_cat(product_id, catalog_id)'),
			'product_c'=>array(self::HAS_MANY, 'Connect', 'product_id'),
		);
	}
	
	public function behaviors(){
		return array(
			'cacheBehavior' =>array(
				'class' => 'application.components.behavior.CacheBehavior',
			),
			'seoBehavior' =>array(
				'class' => 'application.components.behavior.SeoBehavior',
			),
			'fileManagerBehavior' => array(
				'class'=> 'application.components.behavior.FileManagerBehavior',
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
			'name' => Yii::t('main', 'Name'),
			'description' => Yii::t('shop', 'Brief description'),
			'content' => Yii::t('shop', 'Complete description'),
			'price' => Yii::t('shop', 'Price'),
			'articul'=>Yii::t('shop', 'Articul'), 
			'share_price' => Yii::t('shop', 'The share price'),
			'date' => Yii::t('main', 'Date'),
			'position' => Yii::t('admin', 'Position'),
			'is_view' => Yii::t('main', 'Is view'),
			'popular' => Yii::t('shop', 'Popular'),
			'is_new' => Yii::t('shop', 'New'),
			'status' => Yii::t('shop', 'Available'),
			'stock' => Yii::t('shop', 'Stock'),
		
			'url' => Yii::t('admin', 'Page Url'),
			'seo_title' => Yii::t('admin', 'SEO Page Title'),
			'seo_description' => Yii::t('admin', 'SEO Page Description'),
			'seo_keywords' => Yii::t('admin','SEO Page Keywords'),
			'ext' => 'Наименование (шт, ...)',
			
		);
	}


	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('articul',$this->articul,true);
		$criteria->compare('price',$this->price);
		$criteria->compare('share_price',$this->share_price);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('position',$this->position);
		$criteria->compare('is_view',$this->is_view);
		$criteria->compare('popular',$this->popular);
		$criteria->compare('is_new',$this->is_new);
		$criteria->compare('stock',$this->stock);
		$criteria->compare('status',$this->status);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('seo_title',$this->seo_title,true);
		$criteria->compare('seo_description',$this->seo_description,true);
		$criteria->compare('seo_keywords',$this->seo_keywords,true);

		return new CActiveDataProvider(get_class($this), array(
			'pagination'=>array(
				'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
			),
			'sort'=>array(
				'defaultOrder'=>'date DESC, id DESC',
			),
			'criteria'=>$criteria,
		));
	}
	public function userSearch()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('name',$this->name,true);
		$criteria->compare('articul',$this->articul,true, 'OR');
		

		return new CActiveDataProvider(get_class($this), array(
			'pagination'=>array(
				'pageSize'=> 20,
			),
			'sort'=>array(
				'defaultOrder'=>'name DESC, id DESC',
			),
			'criteria'=>$criteria,
		));
	}
	
	public function getId(){
        return $this->tableName().'_'.$this->id;
    }
 
    public function getPrice(){
        if(isset($this->share_price) && $this->share_price != 0)
    		$price = $this->share_price*(float)Settings::getVal('price');
    	else
       		$price = $this->price*(float)Settings::getVal('price');
    	return Helper::roundPrice($price);
    }
    
    protected function beforeValidate() {
    	$this->description = nl2br($this->description);
    	parent::beforeValidate();
    	return true;
    }
    
    public function afterSave() {
    	if(isset($_POST['Catalog_list'])) {
    		if(!$this->isNewRecord)
    			self::deleteFromConnect($_POST['Catalog_list'], $this->id);
    		self::insertIntoConnect($_POST['Catalog_list'], $this->id);
    	}
    	
    	$search = new Search();
    	$storeHelper = new StoreHelper;
    	$path = Yii::app()->controller->widget('bootstrap.widgets.BsBreadcrumb',
        	array(
        		'links'=>$storeHelper->breadcrumb($this->catalog, $this->name),
        			'encodeLabel'=>false,
        			'separator'=>'<span class = "breadcrumb_separator">/</span>',
        	), true);
    	
    	$search->save(__CLASS__, $this->id, $this->name, $this->content, Yii::app()->createUrl('store/product/view', array('url'=>$this->url)), $path);
    	
    	parent::afterSave();
    	return true;
    }
    
   
    public function afterDelete() {
    	Connect::model()->deleteAll('product_id=:product_id', array(':product_id' => $this->id));
    	
    	$search = new Search();
    	$search -> removeFromIndex(__CLASS__, $this->id);
    	
    	parent::afterDelete();
    	return true;
    }
	
	/**
	 * Добавление записей в таблицу - связку
	 * @param array $catalogArray 
	 * @param int $productId
	 */
	public static function insertIntoConnect($catalogArray, $productId) {
		if(count($catalogArray)>0) {
			foreach($catalogArray as $v) {
				$count = Connect::model()->count("catalog_id=:catalog_id AND product_id=:product_id", array(":catalog_id" => $v, ':product_id'=>$productId));
				if($count != 0){
					continue;
				}
				else {
					$model = new Connect();
					$model->catalog_id = $v;
					$model->product_id = $productId;
					$model->save();
				}
			}
		}
	}
	
	/**
	 * Удаление записей из таблицы - связки
	 * @param array $catalogArray
	 * @param int $productId
	 */
	public static function deleteFromConnect($catalogArray, $productId) {
		$sql = 'DELETE FROM tbl_prod_cat WHERE product_id = '.$productId.'';
		$data = implode(', ', $catalogArray);
		if($data != '') {
			$sql = $sql.' AND catalog_id NOT IN ('.$data.')';
		} 
		Yii::app()->db->createCommand($sql)->execute();
	}
	
	/**
	 * Получение актуальной цены товара
	 * @param mixed $product
	 * @return float
	 */
	public static function getCost($product = false) {
		if(is_array($product)){
			if(isset($product['share_price']) && $product['share_price'] != 0)
				$cost = $product['share_price'];
			else
				$cost = $product['price'];
		}
		return $cost;
	}
	

}