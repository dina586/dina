<?php

/**
 * @author Nicholas Kobets <wemadefoxnever@gmail.com>
 * @copyright 365-solutions.com
 * @license http://365-solutions.com/general-license
 */
class ViewController extends Controller {

	public $defaultAction = 'profile';
	public $layout = '//layouts/templates/general';

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
				'actions' => array('profile', 'edit', 'changePassword'),
				'users' => array('@'),
			],
			[
				'deny',
				'users' => array('*'),
			],
		];
	}

	protected function beforeAction($event) {
		//$this->seo($this->titles());
		return true;
	}

	/**
	 * Профиль пользователя
	 * @param int $id
	 */
	public function actionProfile($id = '') {
		$this->layout = '//layouts/templates/admin';
		if ($id == '')
			$id = Yii::app()->user->id;
		$model = System::loadModel('User', $id);
		$this->render('profile', array('model' => $model));
	}

	/**
	 * Редактирование профиля пользователя
	 * @param int $id
	 */
	public function actionEdit($id = '') {
		$this->layout = '//layouts/templates/general';
		if (($id != '' && $id != Yii::app()->user->id) || !Yii::app()->user->checkAccess('admin'))
			throw new CHttpException(403);
		if ($id == '')
			$id = Yii::app()->user->id;

		$model = System::loadModel('User', $id);
		$profile = $model->profile;
		if (isset($_POST['User'])) {
			$model->attributes = array_map('trim', $_POST['User']);
			$profile->attributes = $_POST['Profile'];
			if ($model->saveData($model, $profile) === true) {
				Yii::app()->user->setFlash('profile', Yii::t('admin', 'Profile information successfully updated!'));
				$this->redirect(array('/user/view/profile'));
			}
		}
		$this->render('edit', array('model' => $model, 'profile' => $profile));
	}

	/**
	 * Изменение пароля пользователем
	 */
	public function actionChangePassword() {
		$model = System::loadModel('User', Yii::app()->user->id);
		$model->scenario = 'change_password';

		if (isset($_POST['ajax'])) {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		if (isset($_POST['User'])) {
			$model->attributes = array_map('trim', $_POST['User']);
			if ($model->validate()) {
				$model->password = $model->new_password;
				$model->activkey = md5(microtime());
				if ($model->save(false)) {
					Yii::app()->user->setFlash('profile', Yii::t('admin', 'New password changed successfully!'));
					$this->redirect(array('/user/view/profile'));
				}
			}
		}
		
		$this->render('change_password', array('model' => $model));
	}

}
