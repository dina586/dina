<?php

/**
 * @author Nicholas Kobets <wemadefoxnever@gmail.com>
 * @copyright 365-solutions.com
 * @license http://365-solutions.com/general-license
 */
class DefaultController extends Controller {

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
				'actions' => array('create', 'update', 'admin', 'delete'),
				'roles' => array('admin'),
			),
			array('deny',
				'users' => array('*'),
			),
		);
	}

	protected function titles() {
		switch (Yii::app()->controller->action->id) {
			case 'create':
				return Yii::t('admin', 'Add new block');
				break;

			case 'update':
				return Yii::t('admin', 'Edit block');
				break;

			case 'admin':
				return Yii::t('admin', 'Admin blocks');
				break;
		}
	}

	protected function beforeAction($event) {
		$this->seo($this->titles());
		return true;
	}

	public function actionCreate() {
		$model = new Block;

		if (isset($_POST['Block'])) {
			$model->attributes = $_POST['Block'];
			if ($model->save())
				$this->redirect(array('admin'));
		}

		$this->render('_form', array(
			'model' => $model,
		));
	}

	public function actionUpdate($id) {
		$model = System::loadModel('Block', $id);

		if (isset($_POST['Block'])) {
			$model->attributes = $_POST['Block'];
			if ($model->save())
				$this->redirect(array('admin'));
		}

		$this->render('_form', array(
			'model' => $model,
		));
	}

	public function actionDelete($id) {
		$model = System::loadModel('Block', $id);
		$model->delete();

		if (!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	public function actionAdmin() {
		if (isset($_GET['pageSize'])) {
			Yii::app()->user->setState('pageSize', (int) $_GET['pageSize']);
			unset($_GET['pageSize']);
		}
		$model = new Block('search');
		$model->unsetAttributes();
		if (isset($_GET['Block']))
			$model->attributes = $_GET['Block'];

		$this->render('admin', array(
			'model' => $model,
		));
	}

}
