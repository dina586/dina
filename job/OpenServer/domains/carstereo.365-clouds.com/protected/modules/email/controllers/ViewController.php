<?php

/**
 * @author Nicholas Kobets <wemadefoxnever@gmail.com>
 * @copyright 365-solutions.com
 * @license http://365-solutions.com/general-license
 */
class ViewController extends Controller {

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
				'actions' => array('update', 'admin', 'sendTest'),
				'roles' => array('admin'),
			),
			array('allow',
				'actions' => array('create', 'delete'),
				'roles' => array('developer'),
			),
			array('deny',
				'users' => array('*'),
			),
		);
	}

	public function titles() {
		switch (Yii::app()->controller->action->id) {
			case 'create':
				return Yii::t('admin', 'Create Email message');
				break;

			case 'update':
				return Yii::t('admin', 'Edit Email message');
				break;

			case 'admin':
				return Yii::t('admin', 'Manage Email messages');
				break;
		}
	}

	public function beforeAction($event) {
		$this->seo($this->titles());
		return true;
	}

	public function actionCreate() {
		$model = new EmailMessage;

		if (isset($_POST['EmailMessage'])) {
			$model->attributes = $_POST['EmailMessage'];
			if ($model->save())
				$this->redirect(array('admin'));
		}

		$this->render('_form', array(
			'model' => $model,
		));
	}

	public function actionUpdate($id) {
		$model = System::loadModel('EmailMessage', $id);

		if (!Yii::app()->request->isAjaxRequest)
			Yii::app()->clientScript->registerPackage('ajaxForm');

		if (isset($_POST['EmailMessage'])) {
			$model->attributes = $_POST['EmailMessage'];
			if ($model->save())
				$this->redirect(array('admin'));
		}

		$this->render('_form', array(
			'model' => $model,
		));
	}

	public function actionSendTest($id) {
		$model = System::loadModel('EmailMessage', $id);

		if (!Yii::app()->request->isAjaxRequest)
			throw new CHttpException(403, Yii::t('admin', 'Access denied'));

		if (isset($_POST['EmailMessage'])) {
			$model->attributes = $_POST['EmailMessage'];
			echo Email::sendTest($model).'<br/>'.Yii::t('admin', 'Do not forget to click "Save" to save your changes!');
		}
	}

	public function actionDelete($id) {
		$model = System::loadModel('EmailMessage', $id);
		$model->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if (!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	public function actionAdmin() {
		if (isset($_GET['pageSize'])) {
			Yii::app()->user->setState('pageSize', (int) $_GET['pageSize']);
			unset($_GET['pageSize']);
		}
		$model = new EmailMessage('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['EmailMessage']))
			$model->attributes = $_GET['EmailMessage'];

		$this->render('admin', array(
			'model' => $model,
		));
	}

}
