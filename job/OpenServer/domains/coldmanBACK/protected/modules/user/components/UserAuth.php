<?php

/**
 * @author Nicholas Kobets <wemadefoxnever@gmail.com>
 * @copyright 365-solutions.com
 * @license http://365-solutions.com/general-license
 */
class UserAuth extends CUserIdentity {

	private $_id;

	public function authenticate() {
		$auth = array('status' => 'error', 'message' => 'test');
		if (strpos($this->username, "@")) {
			$user = User::model()->find('email=:email', array(':email' => $this->username));
		} else {
			$user = User::model()->find('login=:login', array(':login' => $this->username));
		}

		if ($user === null) {
			if (strpos($this->username, "@")) {
				$auth['message'] = Yii::t('admin', 'Email is incorrect.');
			} else {
				$auth['message'] = Yii::t('admin', 'Login is incorrect.');
			}
		} elseif (!CPasswordHelper::verifyPassword($this->password, $user->password)) {
			$auth['message'] = Yii::t('admin', 'Password is incorrect.');
		} elseif ($user->status == 0) {
			$auth['message'] = Yii::t('admin', 'You account is not activated.');
		} elseif ($user->status == 2) {
			$auth['message'] = Yii::t('admin', 'You account is blocked.');
		} else {
			$this->_id = $user->id;
			$this->username = $user->email;
			$this->errorCode = self::ERROR_NONE;
			$auth = array('status' => 'ok');
		}
		return $auth;
	}

	/**
	 * @return integer the ID of the user record
	 */
	public function getId() {
		return $this->_id;
	}

}
