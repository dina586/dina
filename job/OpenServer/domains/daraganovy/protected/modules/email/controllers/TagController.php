<?php

/**
 * @author Nicholas Kobets <wemadefoxnever@gmail.com>
 * @copyright 365-solutions.com
 * @license http://365-solutions.com/general-license
 */
class TagController extends Controller {

	public $layout = '//layouts/templates/admin';

	public function filters() {
		return array(
			'accessControl',
			'postOnly + delete',
		);
	}

	public function accessRules() {
		return array(
			array('allow',
				'actions' => array('update', 'admin', 'create', 'delete'),
				'roles' => array('developer'),
			),
			array('deny', // deny all users
				'users' => array('*'),
			),
		);
	}

	public function titles() {
		switch (Yii::app()->controller->action->id) {
			case 'create':
				return Yii::t('admin', 'Create Email tag');
				break;

			case 'update':
				return Yii::t('admin', 'Edit Email tag');
				break;

			case 'admin':
				return Yii::t('admin', 'Manage Email tags');
				break;
		}
	}

	public function beforeAction($event) {
		$this->seo($this->titles());
		return true;
	}

	public function actionCreate() {
		$model = new EmailTags;

		if (isset($_POST['EmailTags'])) {
			$model->attributes = $_POST['EmailTags'];
			if ($model->save())
				$this->redirect(array('admin'));
		}

		$this->render('_form', array(
			'model' => $model,
		));
	}

	public function actionUpdate($id) {
		$model = System::loadModel('EmailTags', $id);

		if (isset($_POST['EmailTags'])) {
			$model->attributes = $_POST['EmailTags'];
			if ($model->save())
				$this->redirect(array('admin'));
		}

		$this->render('_form', array(
			'model' => $model,
		));
	}

	public function actionDelete($id) {
		$model = System::loadModel('EmailTags', $id);
		$model->delete();

		if (!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	public function actionAdmin() {
		if (isset($_GET['pageSize'])) {
			Yii::app()->user->setState('pageSize', (int) $_GET['pageSize']);
			unset($_GET['pageSize']);
		}
		$model = new EmailTags('search');
		$model->unsetAttributes();
		if (isset($_GET['EmailTags']))
			$model->attributes = $_GET['EmailTags'];

		$this->render('admin', array(
			'model' => $model,
		));
	}

}
