<?php

/**
 * @author Nicholas Kobets <wemadefoxnever@gmail.com>
 * @copyright 365-solutions.com
 * @license http://365-solutions.com/general-license
 */
class UserModule extends CWebModule {

	//Статус пользователя на сайте
	public $status;
	//Время на сколько пользователь логинится, 30 дней по умолчанию
	public $rememberMeTime = 2592000;
	//Ссылка для перехода после авторизации
	public $returnUrl = '/admin';
	//Папка где хранятся аватары
	public $avatarFolder = 'avatars';
	
	public $noAvatar = '/images/system/user/noavatar.png';

	public function init() {
		$this->status = array(0 => Yii::t('admin', 'Not activated'), 1 => Yii::t('admin', 'Activated'), 2 => Yii::t('admin', 'Banned'));

		$this->setImport([
			'user.models.*',
			'user.components.*',
		]);
		$this->userPackage();
	}

	public function beforeControllerAction($controller, $action) {
		if (parent::beforeControllerAction($controller, $action)) {
			return true;
		} else
			return false;
	}

	public function userPackage() {
		Yii::app()->clientScript->packages['user_module'] = [
			'basePath' => 'application.modules.user.assets',
			'js' => [
				'user.jquery.js',
			],
			'css' => [
				'user.css',
			],
			'depends' => array('admin_theme'),
		];
		Yii::app()->clientScript->registerPackage('user_module');
	}

}
