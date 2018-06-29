<?php

/**
 * @author Nicholas Kobets <wemadefoxnever@gmail.com>
 * @copyright 365-solutions.com
 * @license http://365-solutions.com/general-license
 */
class Controller extends CController {

	//Текущий файл layout
	public $layout;

	public $menu = array();

	//Хлебные крошки для вывода на странице
	public $breadcrumbs = array();
	
	public function seo($title = null, $seoKeywords = null, $seoDescription = null, $name = null) {
		SeoHelper::getInstance()-> init($title, $seoKeywords, $seoDescription, $name);
		$this->pageTitle = SeoHelper::getInstance()->getTitle();
	}
	
	public function init() {
		$this->pageTitle = SeoHelper::getInstance()->getTitle();
	}

}
