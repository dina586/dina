<?php

class ViewController extends Controller {

	/**
	 * @var string the default layout for the views
	 */
	public $layout = '//layouts/templates/admin';

	/**
	 * @return array action filters
	 */
	public function filters() {
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules() {
		return array(
			array('allow', // allow all users to perform 'index' and 'view' actions
				'actions' => array('index', 'view', 'pdf'),
				'users' => array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions' => array('create', 'update', 'admin', 'delete'),
				'roles' => array('admin'),
			),
			array('deny', // deny all users
				'users' => array('*'),
			),
		);
	}

	public function titles() {
		switch (Yii::app()->controller->action->id) {
			case 'create':
				return Yii::t('admin', 'Create new');
				break;

			case 'update':
				return Yii::t('admin', 'Edit procedure');
				break;

			case 'admin':
				return Yii::t('admin', 'Manage');
				break;

			case 'seo':
				return Yii::t('admin', 'Manage SEO');
				break;

			case 'index':
				return Yii::t('admin', 'Discount Coupons From MJ Car Stereo | Orange, CA');
				break;
		}
	}

	protected function beforeAction($event) {
		$this->seo($this->titles());
		return true;
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($url) {
		$this->layout = '//layouts/templates/base';
		$model = System::loadModel('Coupons', null, $url);
		$this->pageTitle = 'Discount Coupons From MJ Car Stereo | Orange, CA';

		$this->render('view', array(
			'model' => $model,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate() {
		$model = new Coupons;

		if (isset($_POST['Coupons'])) {
			$model->attributes = $_POST['Coupons'];

			if ($model->save())
				$this->redirect(array('admin'));;
		}

		$this->render('_form', array(
			'model' => $model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id) {
		$model = System::loadModel('Coupons', $id);

		if (isset($_POST['Coupons'])) {
			$model->attributes = $_POST['Coupons'];
			if ($model->save())
				$this->redirect(array('admin'));
		}

		$this->render('_form', array(
			'model' => $model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id) {
		$model = System::loadModel('Coupons', $id);
		$model->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if (!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex() {
		$this->layout = '//layouts/templates/base';

		$dataProvider = new CActiveDataProvider('Coupons', array(
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

	public function actionPrint($id) {
		Yii::import('application.modules.coupons.models.Coupons');

		$this->layout = '//layouts/templates/base';
		$coupon = Coupons::model()->findByPk($id);

		$this->render('print', array(
			'coupon' => $coupon,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin() {
		if (isset($_GET['pageSize'])) {
			Yii::app()->user->setState('pageSize', (int) $_GET['pageSize']);
			unset($_GET['pageSize']);
		}
		$model = new Coupons('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['Coupons']))
			$model->attributes = $_GET['Coupons'];

		$this->render('admin', array(
			'model' => $model,
		));
	}

	public function actionSeo() {
		if (isset($_GET['pageSize'])) {
			Yii::app()->user->setState('pageSize', (int) $_GET['pageSize']);
			unset($_GET['pageSize']);
		}
		$model = new Coupons('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['Coupons']))
			$model->attributes = $_GET['Coupons'];

		$this->render('helper_view.parts.global.seo', array(
			'model' => $model,
		));
	}

	public function actionPdf($id) {
		Yii::import('application.modules.coupons.models.Coupons');
		$this->layout = '//layouts/templates/empty';

		$coupon = Coupons::model()->findByPk($id);

		$data = $this->render('application.modules.coupons.views.view.pdf', array('coupon' => $coupon), true);
		$mPDF1 = Yii::app()->ePdf->mpdf('', 'Letter');
		$stylesheet = utf8_encode(file_get_contents(Yii::getPathOfAlias('webroot').DS.'css'.DS.'coupon.css'));
		$mPDF1->WriteHTML($stylesheet, 1);
		$mPDF1->WriteHTML($data);

		$mPDF1->Output('Coupon.pdf', 'I');
	}

}
