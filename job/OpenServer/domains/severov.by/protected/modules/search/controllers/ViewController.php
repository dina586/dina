<?php

class ViewController extends Controller
{
	public $defaultAction = 'search';
    /**
     * @var string index dir as alias path from <b>application.</b>  , default to <b>runtime.search</b>
     */
    
    public $layout = '//layouts/templates/base';
    
    /**
     * (non-PHPdoc)
     * @see CController::init()
     */

    public function actionIndex() {
    	$this->layout='//layouts/templates/base';
    	$this->render('index');
    }
    
 	public function actionOptimization() {
 		// Открытие существующего индекса
		$index = Zend_Search_Lucene::open(Yii::getPathOfAlias('application.' . $this->_indexFiles));
		// Оптимизация индекса
		$index->optimize();
 	}
 	
	public function actionCreate()
    {
    	$dir = Yii::getPathOfAlias('application').DS.'runtime'.DS.'search'.DS;
    	Yii::app()->cFile->set($dir)->delete();
    	Yii::app()->cFile->createDir($dir);
    	Yii::app()->cFile->set($dir, true)->setPermissions('0777');
    	
    	set_time_limit(36000000);
		ini_set("memory_limit","1500M");
   
        $search = new Search();
        $index = $search->config(true);
		
        Yii::import('application.modules.store.models.Product');
        $products = Product::model()->findAll();
        $extraUrl = 'product';
        foreach($products as $product){
        	$pk = $product->id;
        	$model = 'Product';
        	$name = $product->name;
        	$content = $product->content;
        	$storeHelper = new StoreHelper;
        	$path = $this->widget('bootstrap.widgets.BsBreadcrumb',
        		array(
        			'links'=>$storeHelper->breadcrumb($product->catalog, $product->name),
        				'encodeLabel'=>false,
        				'separator'=>'<span class = "breadcrumb_separator">/</span>',
        		), true);
        	$url = Yii::app()->createUrl('store/product/view', array('url'=>$product->url));
        
        	//echo $path;
        	$doc = new Zend_Search_Lucene_Document();
        
        	$doc->addField(Zend_Search_Lucene_Field::Keyword('pk', $pk, "utf-8"));
        	$doc->addField(Zend_Search_Lucene_Field::Keyword('model', $model, "utf-8"));
        
        	$name = strip_tags($name);
        	$content = strip_tags($content);
        
        	//поля для поиска
        	$doc->addField(Zend_Search_Lucene_Field::Text('name', $name, "utf-8"));
        	$doc->addField(Zend_Search_Lucene_Field::Text('content', $content, "utf-8"));
        
        	//Путь в поиске для вывода
        	$doc->addField(Zend_Search_Lucene_Field::UnIndexed('path', $path, "utf-8"));
        	$doc->addField(Zend_Search_Lucene_Field::UnIndexed('url', $url, "utf-8"));
        
        	$index->addDocument($doc);
        }
        $index->optimize();
        $index->commit();
        
       
        $index->optimize();
        $index->commit();
        
    }

	public function actionSearch()
    {
    	
    	$search = new SearchForm;
    	$term = '';
    	if(isset($_GET['SearchForm']) && $_GET['SearchForm']!='')
    		$term = trim($_GET['SearchForm']['term']);
    	elseif((isset($_GET['q']) && $_GET['q'] != '')) 
    		$term = trim($_GET['q']);
    	
    	$search->term = $term;
    		
    	if (isset($_GET['pageSize'])) {
    		Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
    		unset($_GET['pageSize']);
    	}

    	$model=new Product('userSearch');
		$model->unsetAttributes();  // clear any default values
		
		$model->name = $term;
		$model->articul = $term;
		
		
		$this->render('base',array(
			'model'=>$model,
			'search'=>$search,
			'term'=>$term,
		));
        
        
	}
	
	
	public function sentenceCut($text, $term, $number=5) {
		
		$term = trim($term);
		preg_match_all("/.*?[.?!](?:\s|$)/s", $text, $items);
		
		$sentenceArray = $items[0];
		
		$textArray = preg_grep('~'.preg_quote($term,'~').'~iu', $sentenceArray);
		
	    	foreach($textArray as $key => $value){
				$firstWord = $key;
				break;
			}
			$firstWord = 0;
			if($firstWord > 2){
				$key = $firstWord - 2;
			}
			else {
				$key = 0;
			}
			$view = '';
			$newText = array_slice($sentenceArray, $key, $number);
			foreach($newText as $value) {
				$view .= $value;
			}
			if($key > 2) {
				$view = '. . .'.$view;
			}
			if($view == '') {
				$view = $text;
			}
		return $view;
	}
}

