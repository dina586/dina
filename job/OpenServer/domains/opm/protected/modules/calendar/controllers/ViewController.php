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
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions' => array('create', 'update', 'admin', 'delete', 'index', 'view', 'getEvents', 'eventData', 'site'),
				'roles' => array('admin'),
			),
			array('deny', // deny all users
				'users' => array('*'),
			),
		);
	}

	public function titles() {
		switch (Yii::app()->controller->action->id) {
			case 'site':
				return Yii::t('admin', 'Calendar');
				break;
			case 'index':
				return Yii::t('admin', 'Calendar');
				break;
			case 'create':
				return Yii::t('admin', 'Add new Event');
				break;

			case 'update':
				return Yii::t('admin', 'Edit Event');
				break;

			case 'admin':
				return Yii::t('admin', 'Manage Events');
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
	public function actionView($id) {
		$model = System::loadModel('Calendar', $id, null);
		$this->seo($model->name);

		$this->render('helper_view.parts.global.view', array(
			'model' => $model,
		));
	}

	public function actionEventData() {
		$id = Yii::app()->request->getParam('id');
		$model = Calendar::model()->findByPk($id);
		$json = array();

		if ($model !== null) {
			$json['status'] = 'ok';
			$json['content'] = $this->renderPartial('_info', array('model' => $model), true);
			$json['name'] = $model->name;
			if ($model->model_name == 'UserService') {
				$json['link'] = Yii::app()->createUrl('/user/procedure/update/', array('id' => $model->model_id));
				$json['link_new_tab'] = 1;
			} else {
				$json['link'] = Yii::app()->createUrl('/calendar/view/update', array('id' => $model->id));
				$json['link_new_tab'] = 0;
			}
		} else {
			$json['status'] = 'error';
			$json['content'] = 'This event does not exist!';
		}

		echo json_encode($json);
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate() {
		$model = new Calendar;

		if (isset($_POST['Calendar'])) {
			$model->attributes = $_POST['Calendar'];
			if ($model->save())
				$this->redirect(array('index'));
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
		$model = System::loadModel('Calendar', $id);

		if (isset($_POST['Calendar'])) {
			$model->attributes = $_POST['Calendar'];
			if ($model->save())
				$this->redirect(array('index'));
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
		$model = System::loadModel('Calendar', $id);
		$model->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if (!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionGetEvents() {
		$startDate = date('Y-m-d', Yii::app()->request->getParam('start'));
		$endDate = date('Y-m-d', Yii::app()->request->getParam('end'));
		$workers = array();
		if (isset($_POST['Workers']))
			$workers = $_POST['Workers'];

		$model = new Calendar();
		$criteria = Calendar::model()->searchEvents($model, $startDate, $endDate, $workers);
		$sqlData = Calendar::model()->findAll($criteria);

		$events = array();

		if (count($sqlData) > 0):
			foreach ($sqlData as $v) {
				$color = '';
				if ($v->worker_id != '' && $v->worker_id != 0)
					$color = $v->worker->color;
				$events[] = array(
					'url' => '#'.$v->id,
					'title' => $v->name,
					'start' => System::saveDate($v->start_date, 'datetime'),
					'end' => System::saveDate($v->end_date, 'datetime'),
					'color' => $color,
					'allDay' => false,
					'rendering' => 'background',
				);
			}
		endif;

		echo json_encode($events);
	}

	public function actionIndex() {
		Yii::app()->clientScript->registerPackage('ajaxForm');
		Yii::app()->clientScript->registerPackage('calendar_module');
		$this->layout = '//layouts/templates/admin';
		$model = new Calendar();
		if (isset($_POST['Calendar'])) {
			$model->attributes = $_POST['Calendar'];
			if ($model->save()) {
				echo 'Calendar event successfully added!';
			}
		} else
			$this->render('index', array('model' => $model));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin() {
		if (isset($_GET['pageSize'])) {
			Yii::app()->user->setState('pageSize', (int) $_GET['pageSize']);
			unset($_GET['pageSize']);
		}
		$model = new Calendar('search');
		$model->unsetAttributes();  // clear any default values
		if (isset($_GET['Calendar']))
			$model->attributes = $_GET['Calendar'];

		$this->render('admin', array(
			'model' => $model,
		));
	}



}
