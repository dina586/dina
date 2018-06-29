<?php

/**
 * @author Nicholas Kobets <wemadefoxnever@gmail.com>
 * @365-solutions.com
 */
class LoginForm extends CFormModel {

	public $login;
	public $password;
	public $verifyCode;
	public $rememberMe;

	public function rules() {
		return array(
			['login, password', 'required'],
			['rememberMe', 'safe'],
			['password', 'authenticate'],
		);
	}

	public function attributeLabels() {
		return array(
			'login' => Yii::t('admin', 'Email or login'),
			'password' => Yii::t('admin', 'Password'),
		);
	}

	public function authenticate($attribute) {
		if (!$this->hasErrors()) {  // we only want to authenticate when no input errors
			$identity = new UserAuth($this->login, $this->password);
			$json = $identity->authenticate();
			if ($json['status'] == 'error')
				$this->addError("status", $json['message']);
			else {
				$duration = $this->rememberMe == 1 ? Yii::app()->controller->module->rememberMeTime : 0;
				Yii::app()->user->login($identity, $duration);
			}
		}
	}

}
