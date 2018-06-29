<?php

/**
 * @author Nicholas Kobets <wemadefoxnever@gmail.com>
 * @copyright 365-solutions.com
 * @license http://365-solutions.com/general-license
 */
class AdminController extends Controller {

	public $defaultAction = 'manage';
	public $layout = '//layouts/templates/admin';

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
				'actions' => array('manage', 'delete', 'create', 'update'),
				'roles' => array('admin'),
			],
			[
				'deny',
				'users' => array('*'),
			],
		];
	}

	protected function titles() {
		switch (Yii::app()->controller->action->id) {
			case 'manage':
				return Yii::t('admin', 'Manage Users');
				break;

			case 'create':
				return Yii::t('admin', 'Add new user');
				break;

			case 'update':
				return Yii::t('admin', 'Edit user information');
				break;
		}
	}

	protected function beforeAction($event) {
		$this->seo($this->titles());
		return true;
	}

	/**
	 * Управление пользователями
	 */
	public function actionManage() {
		if (isset($_GET['pageSize'])) {
			Yii::app()->user->setState('pageSize', (int) $_GET['pageSize']);
			unset($_GET['pageSize']);
		}

		$model = new User('search');
		$model->unsetAttributes();
		if (isset($_GET['User']))
			$model->attributes = $_GET['User'];

		$this->render('manage', array(
			'model' => $model,
		));
	}

	/**
	 * Добавление нового пользователя
	 */
	public function actionCreate() {
		$model = new User;
		$profile = new Profile;
		if (isset($_POST['User'])) {
			$model->attributes = array_map('trim', $_POST['User']);
			$profile->attributes = $_POST['Profile'];

			if ($model->saveData($model, $profile) === true)
				$this->customRedirect($model, Yii::t('admin', 'New user create successfully!'));
		}
		$this->render('_form', array('model' => $model, 'profile' => $profile));
	}

	public function actionUpdate($id) {
		$model = System::loadModel('User', $id);
		$profile = $model->profile;
		$password = $model->password;

		if (isset($_POST['User'])) {
			$model->attributes = array_map('trim', $_POST['User']);
			$profile->attributes = $_POST['Profile'];

			if ($model->password != $password)
				$model->password = CPasswordHelper::hashPassword($model->password);

			if ($model->saveData($model, $profile) === true)
				$this->customRedirect($model, Yii::t('admin', 'Profile information successfully updated!'));
		}
		$this->render('_form', array('model' => $model, 'profile' => $profile));
	}

	/**
	 * Удаление пользователя
	 * @param int $id
	 * @throws CHttpException
	 */
	public function actionDelete($id) {
		if (Yii::app()->request->isAjaxRequest) {
			$model = System::loadModel('User', $id);
			$model->delete();
		} else
			throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
	}

	protected function customRedirect($model, $message) {
		Yii::app()->user->setFlash('profile', $message);
		if (isset($_POST['yt0']))
			$this->redirect(array('/user/admin/manage'));
		else
			$this->redirect(array('/user/view/profile', 'id' => $model->id));
	}

}
