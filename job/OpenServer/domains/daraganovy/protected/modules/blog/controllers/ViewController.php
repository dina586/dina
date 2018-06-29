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
			array('deny',
				'users' => array('*'),
			),
		);
	}

	public function titles() {
		switch (Yii::app()->controller->action->id) {
			case 'create':
				return Yii::t('admin', 'Добавить статью в блог');
				break;

			case 'update':
				return Yii::t('admin', 'Редактировать статью в блоге');
				break;

			case 'admin':
				return Yii::t('admin', 'Блог');
				break;

			case 'seo':
				return Yii::t('admin', 'Manage SEO');
				break;

			case 'index':
				return Yii::t('admin', 'Блог');
				break;
		}
	}

	public function beforeAction($event) {
		$this->seo(Helper::seoPage($this->titles(), 'Blog_page'), '', Helper::seoPage($this->titles(), 'Blog_page'));
		return true;
	}

	public function actionView($id) {
		$this->layout = '//layouts/templates/base';
		$model = System::loadModel('Blog', $id);
		
		$this->render('application.views.layouts.global.view', array(
			'model' => $model,
		));
	}

	public function actionCreate() {
		$model = new Blog;

		if (isset($_POST['Blog'])) {
			$model->attributes = $_POST['Blog'];

			if ($model->save())
				$this->redirect([Helper::seoLink($model->id, get_class($model))]);
		}

		$this->render('_form', array(
			'model' => $model,
		)); 
	}

	public function actionUpdate($id) {
		$model = System::loadModel('Blog', $id);

		if (isset($_POST['Blog'])) {
			$model->attributes = $_POST['Blog'];
			if ($model->save()) 
				$this->redirect(array(Helper::seoLink($model->id, get_class($model))));
		}

		$this->render('_form', array(
			'model' => $model,
		));
	}

	public function actionDelete($id) {
		$model = System::loadModel('Blog', $id);
		$model->delete();

		if (!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	public function actionIndex() {
		$this->layout = '//layouts/templates/base';

		$dataProvider = new CActiveDataProvider('Blog', array(
			'criteria' => array(
				"condition" => "is_view = 1",
				'order' => 'id DESC',
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
		$model = new Blog('search');
		$model->unsetAttributes();
		if (isset($_GET['Blog']))
			$model->attributes = $_GET['Blog'];

		$this->render('admin', array(
			'model' => $model,
		));
	}

}
