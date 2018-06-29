<?php

/**
 * @author Nicholas Kobets <wemadefoxnever@gmail.com>
 * @copyright 365-solutions.com
 * @license http://365-solutions.com/general-license
 */
class ProductModule extends CWebModule {

	public $defaultController = 'view';
	public $folder = 'product';

	public function init() {
		$this->setImport([
			'product.models.*',
			'product.components.*',
		]);
	}

	public function beforeControllerAction($controller, $action) {
		if (parent::beforeControllerAction($controller, $action)) {
			return true;
		} else
			return false;
	}

}
