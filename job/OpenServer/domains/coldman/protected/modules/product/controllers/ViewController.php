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
				return Yii::t('admin', 'Create new product');
				break;

			case 'update':
				return Yii::t('admin', 'Edit product');
				break;

			case 'admin':
				return Yii::t('admin', 'Manage product');
				break;

			case 'seo':
				return Yii::t('admin', 'Manage SEO');
				break;

			case 'index':
				return Yii::t('admin', 'Product');
				break;
		}
	}

	public function beforeAction($event) {
		//$this->seo(Helper::seoPage($this->titles(), 'News_page'), '', Helper::seoPage($this->titles(), 'News_page'));
		$this->seo($this->titles());
		return true;
	}

	public function actionView($id) {
		$this->layout = '//layouts/templates/base';
		$model = System::loadModel('Product', $id);

		$this->render('application.views.layouts.global.view', array(
			'model' => $model,
		));
	}

	public function actionCreate() {
		$model = new Product;

		if (isset($_POST['Product'])) {
			$model->attributes = $_POST['Product'];

			if ($model->save())
				$this->redirect([Helper::seoLink($model->id, get_class($model))]);
		}

		$this->render('_form', array(
			'model' => $model,
		)); 
	}

	public function actionUpdate($id) {
		$model = System::loadModel('Product', $id);

		if (isset($_POST['Product'])) {
			$model->attributes = $_POST['Product'];
			if ($model->save()) 
				$this->redirect(array(Helper::seoLink($model->id, get_class($model))));
		}

		$this->render('_form', array(
			'model' => $model,
		));
	}

	public function actionDelete($id) {
		$model = System::loadModel('Product', $id);
		$model->delete();

		if (!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	public function actionIndex() {
		$this->layout = '//layouts/templates/front_page';
                 $this->pageTitle = 'Продукты и решения'; 
		$dataProvider = new CActiveDataProvider('Product', array(
			'criteria' => array(
				"condition" => "is_view = 1",
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
		$model = new Product('search');
		$model->unsetAttributes();
		if (isset($_GET['Product']))
			$model->attributes = $_GET['Product'];

		$this->render('admin', array(
			'model' => $model,
		));
	}

}
