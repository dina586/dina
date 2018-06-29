<?php

/**
 * @author Nicholas Kobets <wemadefoxnever@gmail.com>
 * @copyright 365-solutions.com
 * @license http://365-solutions.com/general-license
 */
class UserModule extends CWebModule {

	public $status;
	public $rememberMeTime = 2592000; // 30 days
	public $returnUrl = '/admin';

	public function init() {
		$this->status = array(0 => Yii::t('admin', 'Not activated'), 1 => Yii::t('admin', 'Activated'), 2 => Yii::t('admin', 'Banned'));

		$this->setImport([
			'user.models.*',
			'user.components.*',
		]);
	}

	public function beforeControllerAction($controller, $action) {
		if (parent::beforeControllerAction($controller, $action)) {
			return true;
		} else
			return false;
	}

}
