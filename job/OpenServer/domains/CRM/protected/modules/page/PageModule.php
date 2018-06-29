<?php

/**
 * @author Nicholas Kobets <wemadefoxnever@gmail.com>
 * @copyright 365-solutions.com
 * @license http://365-solutions.com/general-license
 */
class PageModule extends CWebModule {

	public $defaultController = 'view';
	
	//Ссылки для редиректа что бы исключить дубли
	public $redirectLinks = [
		1 => '/site/index',
		2 => '/site/contact',
	];

	public function init() {
		$this->setImport(array(
			'page.models.*',
			'page.components.*',
		));
	}

}
