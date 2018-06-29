<?php

/**
 * @author Nicholas Kobets <wemadefoxnever@gmail.com>
 * @copyright 365-solutions.com
 * @license http://365-solutions.com/general-license
 */
class SeoHelper {

	protected static $_instance;
	
	protected $pageTitle;
	protected $seoDescription;
	protected $seoKeyWords;

	private function __construct() {
		
	}

	private function __clone() {
		
	}
	
	public static function getInstance() {
		if (null === self::$_instance) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	public function getTitle() {
		return $this->pageTitle;
	}
	
	/**
	 * Инициализируем сео в контроллере
	 * @param string $title
	 * @param string $seoDescription
	 * @param string $seoKeyWords
	 * @param string $name если тайтл пустой, будет выводиться имя
	 */
	public function init($title = null, $seoDescription = null, $seoKeyWords = null, $name = null) {
		if($title == '')
			$title = $name;
		if($title == '')
			$title = Settings::getVal ('site_name');
		
		if($seoDescription == '')
			$seoDescription = Settings::getVal('default_seo_description');
		
		if($seoKeyWords == '')
			$seoKeyWords = Settings::getVal('default_seo_keywords');
		
		$this->pageTitle = $this->prepairRender($title);
		$this->seoDescription = $this->prepairRender($seoDescription);
		$this->seoKeyWords = $this->prepairRender($seoKeyWords);
	}
	
	/**
	 * Выводим мета данные на страницу
	 */
	public function renderMetaTags() {
		$view = '<title>'.$this->pageTitle.'</title>'.PHP_EOL;
		$view .= CHtml::metaTag($this->seoDescription, 'description').PHP_EOL;
		$view .= CHtml::metaTag($this->seoKeyWords, 'keywords').PHP_EOL;
		return $view;
	}
	
	protected function prepairRender($tag) {
		return CHtml::encode(strip_tags($tag));
	}

}
