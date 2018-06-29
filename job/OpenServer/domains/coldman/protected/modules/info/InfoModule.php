<?php

/**
 * @author Nicholas Kobets <wemadefoxnever@gmail.com>
 * @copyright 365-solutions.com
 * @license http://365-solutions.com/general-license
 */
class InfoModule extends CWebModule {

	public $defaultController = 'view';
	public $folder = 'info';

	public function init() {
		$this->setImport([
			'info.models.*',
			'info.components.*',
		]);
	}

	public function beforeControllerAction($controller, $action) {
		if (parent::beforeControllerAction($controller, $action)) {
			return true;
		} else
			return false;
	}

}
