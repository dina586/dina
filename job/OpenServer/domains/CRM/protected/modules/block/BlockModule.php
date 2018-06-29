<?php

/**
 * @author Nicholas Kobets <wemadefoxnever@gmail.com>
 * @copyright 365-solutions.com
 * @license http://365-solutions.com/general-license
 */
class BlockModule extends CWebModule {

	public $namespace = array();

	public function init() {
		$this->namespace = array(
        	'capabilities'=>Yii::t('admin', 'Возможности'),
        	'show'=>Yii::t('admin', 'Шоу-рум'),
        	'show_img'=>Yii::t('admin', 'Шоу-рум изображения'),
        	'question'=>Yii::t('admin', 'Вопросы'),
        	'contacts'=>Yii::t('admin', 'Контакты'),
        	'footer'=>Yii::t('admin', 'Подвал'),
        );
		$this->setImport([
			'block.models.*',
			'block.components.*',
		]);
	}

	public function beforeControllerAction($controller, $action) {
		if (parent::beforeControllerAction($controller, $action)) {
			return true;
		} else
			return false;
	}

}
