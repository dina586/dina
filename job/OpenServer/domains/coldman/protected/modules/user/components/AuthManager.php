<?php

/**
 * @author Nicholas Kobets <wemadefoxnever@gmail.com>
 * @copyright 365-solutions.com
 * @license http://365-solutions.com/general-license
 */
class AuthManager extends CPhpAuthManager {

	public function init() {
		// Иерархию ролей расположим в файле auth.php в директории config приложения
		$this->authFile = Yii::getPathOfAlias('application.config.auth') . '.php';

		parent::init();

		if (!Yii::app()->user->isGuest) {
			$this->assign(UserHelper::getRole(Yii::app()->user->id), Yii::app()->user->id);
		}
	}

}
