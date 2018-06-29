<?php

/**
 * @author Nicholas Kobets <wemadefoxnever@gmail.com>
 * @copyright 365-solutions.com
 * @license http://365-solutions.com/general-license
 */
class EmailModule extends CWebModule {

	public $emailFor;
	public $tagType;

	public function init() {

		$this->emailFor = array(
			1 => Yii::t('admin', 'For admin'),
			2 => Yii::t('admin', 'For user'),
		);

		$this->tagType = array(
			1 => Yii::t('admin', 'Simple text'),
			2 => Yii::t('admin', 'Link'),
			3 => Yii::t('admin', 'HTML'),
			4 => Yii::t('admin', 'HTML table'),
		);

		$this->setImport(array(
			'email.models.*',
			'email.components.*',
		));
	}

	public function beforeControllerAction($controller, $action) {
		if (parent::beforeControllerAction($controller, $action)) {
			return true;
		} else
			return false;
	}

}
