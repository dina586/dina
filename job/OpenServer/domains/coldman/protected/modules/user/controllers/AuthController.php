<?php

/**
 * @author Nicholas Kobets <wemadefoxnever@gmail.com>
 * @copyright 365-solutions.com
 * @license http://365-solutions.com/general-license
 */
class AuthController extends Controller {

	public $defaultAction = 'login';
	public $layout = '/layouts/back_to_login';

	public function filters() {
		return array(
			'accessControl',
			'postOnly + delete',
		);
	}

	public function accessRules() {
		return [
			[
				'allow',
				'actions' => array('login', 'registration', 'activation', 'recovery', 'newPassword'),
				'users' => array('*'),
			],
			[
				'allow',
				'actions' => array('logout'),
				'users' => array('@'),
			],
			[
				'deny',
				'users' => array('*'),
			],
		];
	}
	
	protected function titles(){
		switch(Yii::app()->controller->action->id){
			case 'login':
				return Yii::t('admin', 'Login Form');
				break;
					
			case 'registration':
				return Yii::t('admin', 'Registration Form');
				break;
					
			case 'activation':
				return Yii::t('admin', 'Account activation');
				break;
			
			case 'recovery':
				return Yii::t('admin', 'Password Recovery');
				break;
			
			case 'newPassword':
				return Yii::t('admin', 'New Password');
				break;
		}
	}

	protected function beforeAction($event) {
		if (!Yii::app()->user->isGuest && Yii::app()->controller->action->id != 'logout')
			$this->redirect(Yii::app()->user->returnUrl);
		$this->seo($this->titles());
		return true;
	}

	/**
	 * Авторизация
	 */
	public function actionLogin() {
		Yii::import('application.modules.user.forms.LoginForm');
		$this->layout = '//layouts/templates/login';
		$model = new LoginForm;

		if (isset($_POST['LoginForm'])) {
			$model->attributes = array_map('trim', $_POST['LoginForm']);
			if ($model->validate()) {
				$this->redirect(Yii::app()->user->returnUrl);
			}
		}
		$this->render('login', ['model' => $model]);
	}
	
	/**
	 * Выход из аккаунта
	 */
	public function actionLogout() {
		$this->layout = false;
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->createUrl('user/auth/login'));
	}

	/**
	 * Регистрация на сайте
	 */
	public function actionRegistration() {

		$model = new User('registration');
		$profile = new Profile('registration');

		if (isset($_POST['User'])) {
			$model->attributes = array_map('trim', $_POST['User']);
			$profile->attributes = $_POST['Profile'];

			if ($model->saveData($model, $profile) === true) {

				$data['LOGIN'] = $model->login;
				$data['PASSWORD'] = $model->confirm_password;
				$data['activation_url'] = BsHtml::link(
					Yii::t('admin', 'account activation'), 
					$this->createAbsoluteUrl('/user/auth/activation', array("activkey" => $model->activkey, "email" => $model->email))
				);

				$flash = Email::send('registration', $data, UserHelper::getName($profile), $model->email);
				Yii::app()->user->setFlash('registration', $flash);
				$this->refresh();
			} else
				$model->password = $model->confirm_password;
		}
		$this->render('registration', ['model' => $model, 'profile' => $profile]);
	}

	/**
	 * Активация аккаунта
	 * @param string $email
	 * @param string $activkey
	 */
	public function actionActivation($email, $activkey) {
		$model = User::model()->find('email=:email', array(':email' => $email));
		$json = array('error' => true, 'message' => 'empty');
		$accountLink = BsHtml::link(Yii::t('admin', 'Back to login form'), $this->createUrl('/user/auth/login'), array('class' => 'text-muted'));

		if ($model === null)
			$json['message'] = Yii::t('admin', 'User with this email address does not exists');
		elseif ($model->status != 0)
			$json['message'] = Yii::t('admin', 'Account already activated.') . '<br/>' . $accountLink;

		elseif ($model->activkey != $activkey)
			$json['message'] = Yii::t('admin', 'Incorrect activation URL.');
		else {
			$model->status = 1;
			$model->activkey = md5(microtime());
			if ($model->save())
				$json = array('message' => 'You account is activated successfully.' . '<br/>' . $accountLink, 'error' => false);
			else {
				$json['message'] = '';
				foreach ($model->getErrors() as $error) {
					$json['message'] = implode('<br/>', $error);
				}
			}
		}

		$this->render('activation', ['json' => $json]);
	}

	/**
	 * Восстановление пароля
	 */
	public function actionRecovery() {
		Yii::import('application.modules.user.forms.RecoveryForm');
		$model = new RecoveryForm;

		if (isset($_POST['RecoveryForm'])) {
			$model->attributes = array_map('trim', $_POST['RecoveryForm']);
			if ($model->validate()) {
				$data['password_recovery'] = BsHtml::link(
					Yii::t('admin', 'Recover password'), 
					$this->createAbsoluteUrl('/user/auth/newPassword', array("activkey" => $model->user->activkey, "email" => $model->user->email))
				);

				$send = Email::send('password_recovery', $data, UserHelper::getName($model->user), $model->user->email);
				Yii::app()->user->setFlash('recoveryMessage', $send);

				$this->refresh();
			}
		}

		$this->render('recovery', ['model' => $model]);
	}

	/**
	 * Изменение пароля пользователя при запросе на восстановление
	 * @param string $email
	 * @param string $activkey
	 */
	public function actionNewPassword($email, $activkey) {
		$model = User::model()->find('email=:email', array(':email' => $email));

		$json = array('error' => true, 'message' => 'empty');
		$accountLink = BsHtml::link(Yii::t('admin', 'Back to login form'), $this->createUrl('/user/auth/login'), array('class' => 'text-muted'));

		if ($model === null)
			$json['message'] = Yii::t('admin', 'User with this email address does not exists');
		elseif ($model->activkey != $activkey)
			$json['message'] = Yii::t('admin', 'Incorrect URL.');
		else {

			$json = array('error' => false, 'message' => '');
			$model->scenario = 'recovery';

			if (isset($_POST['User'])) {
				$model->attributes = $_POST['User'];
				$model->scenario = 'recovery';
				$model->password = $model->new_password;
				if ($model->save()) {
					$json['message'] = Yii::t('admn', 'Password successfully changed') . '<br/>' . $accountLink;
					Yii::app()->user->setFlash('recoveryComplete', $this->renderPartial('/layouts/message', array('json' => $json), true));
					$this->refresh();
				} else {
					foreach ($model->getErrors() as $error) {
						$json['message'] = implode('<br/>', $error);
					}
				}
			}
		}

		$this->render('new_password', ['json' => $json, 'model' => $model]);
	}

}
