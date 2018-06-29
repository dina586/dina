<?php

/**
 * @author Nicholas Kobets <wemadefoxnever@gmail.com>
 * @copyright 365-solutions.com
 * @license http://365-solutions.com/general-license
 */
class NewsModule extends CWebModule {

	public $defaultController = 'view';
	public $folder = 'news';

	public function init() {
		$this->setImport([
			'news.models.*',
			'news.components.*',
		]);
	}

	public function beforeControllerAction($controller, $action) {
		if (parent::beforeControllerAction($controller, $action)) {
			return true;
		} else
			return false;
	}

}
