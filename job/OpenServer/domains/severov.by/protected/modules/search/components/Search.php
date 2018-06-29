<?php 
class Search extends CApplicationComponent {
	
	//Путь к файлам индекса
	private $_indexFiles = 'runtime.search';
	
	public function __construct() {
		$this->_indexFiles = Yii::getPathOfAlias('application.' . $this->_indexFiles);
		Yii::import('application.modules.search.vendors.*');
		require_once('Zend/Search/Lucene.php');
	}
	
	/**
	 * Конфигурация zend lucene
	 */
	public function config($create = false){
		$lang = strtolower(Yii::app()->language).'_'.strtoupper(Yii::app()->language);
		setlocale(LC_CTYPE, $lang.'.UTF-8');
		Zend_Search_Lucene_Search_QueryParser::setDefaultEncoding('utf-8');
		Zend_Search_Lucene_Analysis_Analyzer::setDefault(new Zend_Search_Lucene_Analysis_Analyzer_Common_Utf8Num_CaseInsensitive());
		
		
		$cFile = Yii::app()->cFile->set($this->_indexFiles, true);
		
		//Если папка пуста, создаем новый индекс
		if(!$cFile -> getIsEmpty() || $create === false)
			return Zend_Search_Lucene::open($this->_indexFiles); 
		else
			return Zend_Search_Lucene::create($this->_indexFiles);
	}
	
	public function path($data, $delimeter = ' » ', $wraperTag = 'p') {
		$view = '';
		if(count($data)>0){
			foreach($data as $value) {
				if(is_array($value) && count($value) > 0) 
					$view .= '<'.$wraperTag.'>'.implode($delimeter, $value).'</'.$wraperTag.'>';
				
			}
			if($view == '') 
				$view .= '<'.$wraperTag.'>'.implode($delimeter, $data).'</'.$wraperTag.'>';
		}
		
		return $view;
	}
	// функция добавляет запись в индекс
	protected function addToIndex($model, $pk, $name, $content, $url, $path = '', $articul = '')
	{
		//инициализации индекса
		$index = $this->config();
		
		//документ - это запись в индексе
		$doc = new Zend_Search_Lucene_Document();
	
		$doc->addField(Zend_Search_Lucene_Field::Keyword('pk', $pk, "utf-8"));
		$doc->addField(Zend_Search_Lucene_Field::Keyword('model', $model, "utf-8"));
		
		$name = strip_tags($name);
		$content = strip_tags($content);
		
		//поля для поиска
		$doc->addField(Zend_Search_Lucene_Field::Text('name', $name, "utf-8"));
		$doc->addField(Zend_Search_Lucene_Field::Text('content', $content, "utf-8"));
		$doc->addField(Zend_Search_Lucene_Field::Keyword('articul', $articul, "utf-8"));
		
		//Путь в поиске для вывода
		$doc->addField(Zend_Search_Lucene_Field::UnIndexed('path', $path, "utf-8"));
		$doc->addField(Zend_Search_Lucene_Field::UnIndexed('url', $url, "utf-8"));
		 
		$index->addDocument($doc);
		$index->commit();
	}
	
	//функция удаляет запись из индекса
	public function removeFromIndex($model, $pk)
	{
		//инициализации индекса
		$index = $this->config();
	
		//составляем запрос с использованием API запросов Zend Lucene
		//суть запроса - поиск продукта по идентификатору
		$query = new Zend_Search_Lucene_Search_Query_MultiTerm();
		$query->addTerm(new Zend_Search_Lucene_Index_Term($pk, 'pk'), true);
		$query->addTerm(new Zend_Search_Lucene_Index_Term($model, 'model'), true);
	
		//ищем и удаляем
		$hits = $index->find($query);
		foreach ($hits as $hit)
			$index->delete($hit->id);
	}
	/**
	 * Сохранение в интексе для стороннего использования
	 * @param model $model
	 * @param id $pk
	 * @param string $name
	 * @param string $content
	 * @param string $path
	 * @param string $articul
	 */
	public function save($model, $pk, $name, $content, $url, $path = '', $articul = '') {
		$this->removeFromIndex($model, $pk);
		$this->addToIndex($model, $pk, $name, $content, $url, $path, $articul);
	}
} 
?>