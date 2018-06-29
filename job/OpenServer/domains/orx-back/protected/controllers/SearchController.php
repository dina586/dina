<?php
Yii::import('application.modules.shop.models.*');


class SearchController extends Controller
{
    /**
     * @var string index dir as alias path from <b>application.</b>  , default to <b>runtime.search</b>
     */
    private $_indexFiles = 'runtime.search';
    /**
     * (non-PHPdoc)
     * @see CController::init()
     */
    public function init(){
        Yii::import('application.vendors.*');
        require_once('Zend/Search/Lucene.php');
        
        parent::init(); 
    }
 
	public function actionCreate()
    {

		$this->layout='//layouts/tmp_2columns';
        set_time_limit(36000000);
		ini_set("memory_limit","1500M");
    	
    	setlocale(LC_CTYPE, 'ru_RU.UTF-8');
        Zend_Search_Lucene_Search_QueryParser::setDefaultEncoding('utf-8');  
        Zend_Search_Lucene_Analysis_Analyzer::setDefault(new Zend_Search_Lucene_Analysis_Analyzer_Common_Utf8Num());   

        $index = new Zend_Search_Lucene(Yii::getPathOfAlias('application.' . $this->_indexFiles), true);
    	
		$index = new Zend_Search_Lucene(Yii::getPathOfAlias('application.' . $this->_indexFiles), true);

		$posts = Product::model()->findAll('is_view=1');

        foreach($posts as $post){
		
			$doc = new Zend_Search_Lucene_Document();
 	    	$doc->addField(Zend_Search_Lucene_Field::Text(
 	    		'name', 
 	    		"<a href = '/shop/product/view/".$post->id."'>".CHtml::encode($post->name)."</a>", 
 	    		'utf-8')
 	    	);

 	    	$a = strip_tags($post->content);
 	    	$doc->addField(Zend_Search_Lucene_Field::Text('content', $a, 'utf-8'));
 	    	$catalogArr = array();
 	    	foreach($post->catalog as $value) {
				$catalogArr[$value->name] = '<a href="'.Yii::app()->createUrl('shop/catalog/view', array('id'=>$value->id)).'">'.$value->name.'</a>';
			}
			$c = implode(' » ', $catalogArr);
			$articul = str_replace(" ","", $product->articul);
			
			$doc->addField(Zend_Search_Lucene_Field::UnIndexed('catalog', $c, 'utf-8'));
			$doc->addField(Zend_Search_Lucene_Field::UnIndexed('prod_id', $post->id, 'utf-8'));
			$doc->addField(Zend_Search_Lucene_Field::UnIndexed('front_image', $post->front_image, 'utf-8'));
			$doc->addField(Zend_Search_Lucene_Field::Keyword('articul', $articul, 'utf-8'));
			
			$index->addDocument($doc);
        }   
        $index->optimize();
		$index->commit();
          
       $this->render('index');
    }
 
	public function actionSearch()
    {
		setlocale(LC_CTYPE, 'ru_RU.UTF-8');
		$this->layout='//layouts/tmp_2columns';
        Yii::app()->clientScript->registerScriptFile('/js/plugins/searchHighlights/jquery.highlight-3.js',CClientScript::POS_HEAD);

        if (($term = Yii::app()->getRequest()->getParam('q', null)) !== null) {
        	try {
        		Zend_Search_Lucene_Analysis_Analyzer::setDefault(new Zend_Search_Lucene_Analysis_Analyzer_Common_Utf8Num());
            
         		$index = new Zend_Search_Lucene(Yii::getPathOfAlias('application.' . $this->_indexFiles));
        		$number = substr_count($term, "-");
	            
	            if($number>0) {
	            	$searchTerm = strtoupper($term);
	            	$results = $index->find('articul:'.$searchTerm);
	            } else  {
		         	$searchTerm = mb_strtolower($term, 'UTF-8');
		         	$results = $index->find($searchTerm);
	            }
	         
	            $query = Zend_Search_Lucene_Search_QueryParser::parse($searchTerm); 
        	}
        	catch (Exception $e) {
			    $results = array();
			}
        }
        $this->render('search', compact('results', 'term', 'query'));
	}
	
	public function sentenceCut($text, $term, $number=5) {
		$view = '';
		
		$term = trim($term);
		preg_match_all("/.*?[.?!](?:\s|$)/s", $text, $items);
		
		$sentenceArray = $items[0];
		
		$textArray = preg_grep('~'.preg_quote($term,'~').'~iu', $sentenceArray);
		
	    	foreach($textArray as $key => $value){
				$firstWord = $key;
				break;
			}
			if($firstWord > 2){
				$key = $firstWord - 2;
			}
			else {
				$key = 0;
			}
			
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

