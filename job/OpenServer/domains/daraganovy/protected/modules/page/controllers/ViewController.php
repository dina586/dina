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
				'actions' => array('view'),
				'users' => array('*'),
			),
			array('allow',
				'actions' => array('update', 'admin'),
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
				return Yii::t('admin', 'Create new page');
				break;

			case 'update':
				return Yii::t('admin', 'Edit page');
				break;

			case 'admin':
				return Yii::t('admin', 'Site Pages');
				break;

			case 'seo':
				return Yii::t('admin', 'Pages Seo');
				break;
		}
	}

	protected function beforeAction($event) {
		$this->seo($this->titles());
		return true;
	}

	public function actionView($url) {
		$this->layout = '//layouts/templates/base';
		$model = System::loadModel('Page', null, $url);
		$this->seo($model->title, $model->keywords, $model->description, $model->name);

		$this->render('application.views.layouts.global.view', array(
			'model' => $model,
		));
	}

	public function actionCreate() {
		$model = new Page;

		if (isset($_POST['Page'])) {
			$model->attributes = $_POST['Page'];
			if ($model->save())
				$this->redirect(array('view', 'url' => $model->url));
		}

		$this->render('_form', array(
			'model' => $model,
		));
	}

	public function actionUpdate($id) {
		$model = System::loadModel('Page', $id);

		if (isset($_POST['Page'])) {
			$model->attributes = $_POST['Page'];
			if ($model->save()) {
				if (key_exists($model->id, $this->module->redirectLinks))
					$this->redirect(array($this->module->redirectLinks[$model->id]));
				else
					$this->redirect(array('view', 'url' => $model->url));
			}
		}

		$this->render('_form', array(
			'model' => $model,
		));
	}

	public function actionDelete($id) {
		$model = System::loadModel('Page', $id);
		$model->delete();

		if (!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}


	
	public function actionAdmin() {
		if (isset($_GET['pageSize'])) {
			Yii::app()->user->setState('pageSize', (int) $_GET['pageSize']);
			unset($_GET['pageSize']);
		}
		$model = new Page('search');
		$model->unsetAttributes();
		if (isset($_GET['Page']))
			$model->attributes = $_GET['Page'];

		$this->render('admin', array(
			'model' => $model,
		));
	}
	
}
