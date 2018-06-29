<?php

/**
 * @author Nicholas Kobets <wemadefoxnever@gmail.com>
 * @365-solutions.com
 */
class RecoveryForm extends CFormModel {

	public $login_email;
	//Объект модели User при успешном нахождении при валидации
	public $user;

	public function rules() {
		return array(
			['login_email', 'required'],
			['login_email', 'checkexists'],
		);
	}

	public function attributeLabels() {
		return array(
			'login_email' => Yii::t('admin', 'Email or login'),
		);
	}

	public function checkexists($attribute) {
		if (!$this->hasErrors()) {
			if (strpos($this->login_email, "@")) {
				$user = User::model()->find('email=:email', array(':email' => $this->login_email));
			} else {
				$user = User::model()->find('login=:login', array(':login' => $this->login_email));
			}

			if ($user === null) {
				if (strpos($this->login_email, "@")) {
					$this->addError("login_or_email", Yii::t('admin', 'Email does not exists'));
				} else {
					$this->addError("login_or_email", Yii::t('admin', 'Login does not exists'));
				}
			} else
				$this->user = $user;
		}
	}

}
