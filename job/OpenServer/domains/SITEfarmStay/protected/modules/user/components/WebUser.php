<?php

/**
 * @author Nicholas Kobets <wemadefoxnever@gmail.com>
 * @copyright 365-solutions.com
 * @license http://365-solutions.com/general-license
 */
class WebUser extends CWebUser {

	protected function afterLogin($fromCookie) {
		parent::afterLogin($fromCookie);
		$this->updateSession();
		
	}

	/**
	 * Пишем данные в сессию пользователя для быстрого доступа
	 * Доступ к данным можно получить через Yii::app()->user->{field}, где {field} - поле из модели user или profile
	 */
	public function updateSession() {
		
		$user = System::loadModel('User', $this->id);
		$user->lastvisit_at = date('Y-m-d H:i:s');
		$user->save(false);
		
		$userAttributes = CMap::mergeArray(
			array(
				'email' => $user->email,
				'login' => $user->login,
				'create_at' => $user->create_at,
				'lastvisit_at' => $user->lastvisit_at,
				'role' => $user->r_role->role_name,
			), 
			$user->profile->getAttributes()
		);
		
		foreach ($userAttributes as $attrName => $attrValue) {
			$this->setState($attrName, $attrValue);
		}
	}

}
