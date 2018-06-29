<?php

/**
 * @author Nicholas Kobets <wemadefoxnever@gmail.com>
 * @copyright 365-solutions.com
 * @license http://365-solutions.com/general-license
 */
class UserHelper {

	/**
	 * Получение имени пользователя
	 * @param mixed $user может принимать id или объект User/Profile
	 * @return string
	 */
	public static function getName($user=false) {
		$model = $user;
		if($user === false && !Yii::app()->user->isGuest)
			return Yii::app()->user->lastname.' '. Yii::app()->user->firstname;
		elseif (is_int($user)) {
			$model = System::loadModel('Profile', $user, '', 'user_id');
		} elseif (get_class($user) == 'User')
			$model = $user->profile;

		return $model->lastname . ' ' . $model->firstname;
	}

	/**
	 * Получение роли пользователя на сайте
	 * @param int $id
	 * @return string
	 */
	public static function getRole($id) {
		$model = System::loadModel('Roles', $id, '', 'user_id');
		return $model->role_name;
	}

}
