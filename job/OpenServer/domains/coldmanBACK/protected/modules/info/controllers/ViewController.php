<?php

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
				'actions' => array('index', 'view'),
				'users' => array('*'),
			),
			array('allow',
				'actions' => array('create', 'update', 'admin', 'delete', 'seo'),
				'roles' => array('admin'),
			),
			array('allow',
				'users' => array('*'),
			),
		);
	}

	public function titles() {
		switch (Yii::app()->controller->action->id) {
			case 'create':
				return Yii::t('admin', 'Create new news');
				break;

			case 'update':
				return Yii::t('admin', 'Edit news');
				break;

			case 'admin':
				return Yii::t('admin', 'Manage news');
				break;

			case 'seo':
				return Yii::t('admin', 'Manage SEO');
				break;

			case 'index':
				return Yii::t('admin', 'Info');
				break;
		}
	}

	public function beforeAction($event) {
		//$this->seo(Helper::seoPage($this->titles(), 'Info_page'), '', Helper::seoPage($this->titles(), 'Info_page'));
		$this->seo($this->titles());
		return true;
	}

	public function actionView($id) {
		$this->layout = '//layouts/templates/base';
		$model = System::loadModel('Info', $id);

		$this->render('application.views.layouts.global.view', array(
			'model' => $model,
		));
	}

	public function actionCreate() {
		$model = new Info;

		if (isset($_POST['Info'])) {
			$model->attributes = $_POST['Info'];

			if ($model->save())
				$this->redirect([Helper::seoLink($model->id, get_class($model))]);
		}

		$this->render('_form', array(
			'model' => $model,
		)); 
	}

	public function actionUpdate($id) {
		$model = System::loadModel('Info', $id);

		if (isset($_POST['Info'])) {
			$model->attributes = $_POST['Info'];
			if ($model->save()) 
				$this->redirect(array(Helper::seoLink($model->id, get_class($model))));
		}

		$this->render('_form', array(
			'model' => $model,
		));
	}

	public function actionDelete($id) {
		$model = System::loadModel('Info', $id);
		$model->delete();

		if (!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	public function actionIndex() {
		$this->layout = '//layouts/templates/base';

		$dataProvider = new CActiveDataProvider('Info', array(
			'criteria' => array(
				"condition" => "is_view = 1",
				'order' => 'date DESC, id DESC',
			),
			'pagination' => array(
				'pageSize' => 10,
			),
		));

		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		if (isset($_GET['pageSize'])) {
			Yii::app()->user->setState('pageSize', (int) $_GET['pageSize']);
			unset($_GET['pageSize']);
		}
		$model = new Info('search');
		$model->unsetAttributes();
		if (isset($_GET['Info']))
			$model->attributes = $_GET['Info'];

		$this->render('admin', array(
			'model' => $model,
		));
	}

}
