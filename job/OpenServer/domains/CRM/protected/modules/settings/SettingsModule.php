<?php

/**
 * @author Nicholas Kobets <wemadefoxnever@gmail.com>
 * @copyright 365-solutions.com
 * @license http://365-solutions.com/general-license
 */
class SettingsModule extends CWebModule {

	//Переменная для отображения или сокрытия разделов/материалов на сайте
	public $isView;
	public $settingsFields = ['input' => 'input', 'textarea' => 'textarea', 'editor' => 'editor'];
	public $settingsModules;

	public function init() {
		$this->isView = array(0 => Yii::t('admin', 'Hidden'), 1 => Yii::t('admin', 'Display'));

		$this->settingsModules = array(
			1 => Yii::t('admin', 'Base module'),
			2 => Yii::t('admin', 'Email Settings'),
			3 => Yii::t('admin', 'User Module'),
			4 => Yii::t('admin', 'SEO Settings'),
			5 => Yii::t('admin', 'Payment'),
			6 => Yii::t('admin', 'Лидер в сфере знаний'),
		);


		$this->setImport([
			'settings.models.*',
			'settings.components.*',
		]);
	}

	public function beforeControllerAction($controller, $action) {
		if (parent::beforeControllerAction($controller, $action)) {
			return true;
		} else
			return false;
	}

}
