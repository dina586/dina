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
        	'header'=>Yii::t('admin', 'Header'),
        	'footer'=>Yii::t('admin', 'Footer'),
        	'front_block'=>Yii::t('admin', 'Front Block'),
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
