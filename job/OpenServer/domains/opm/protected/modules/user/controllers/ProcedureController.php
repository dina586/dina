<?php
Yii::import('application.modules.service.models.*');

class ProcedureController extends Controller
{
	public $defaultAction = 'admin';
	
	public $layout='//layouts/templates/admin';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
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
	public function accessRules()
	{
		return array(
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('create','update', 'manage', 'delete', 'signature'),
				'roles'=>array('admin'),
			),

			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	
	public function titles(){
		switch(Yii::app()->controller->action->id){
			case 'create':
				return Yii::t('admin', 'Add new procedure for client');
				break;
					
			case 'update':
				return Yii::t('admin', 'Edit user procedure');
				break;
					
			case 'admin':
				return Yii::t('admin', 'Manage Procedures');
				break;
		}
	}
	
	protected function beforeAction($event)
	{
		$this->seo($this->titles());
		return true;
	}
	
	public function actionSignature($id)
	{
		Yii::app()->clientScript->registerPackage('jsignature');
		$model = System::loadModel('UserService', $id);
		
		if(isset($_POST['UserService']))
		{
			$model->attributes=$_POST['UserService'];
			if($model->save()) {
				$this->redirect(array('/user/admin/view', 'id'=>$model->user_id));
			}
		}
		
		$this->render('signature',array(
			'model'=>$model,
		));
	}
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate($user_id)
	{
		$model = new UserService;
		$model->user_id = $user_id;

		if(isset($_POST['UserService']))
		{
			$model->attributes=$_POST['UserService'];
			if($model->view_in_calendar == 1)
				$model->scenario = 'add_to_calendar';
			if($model->save()) {
				if(isset($_POST['yt0']))
					$this->redirect(array('/user/admin/view', 'id'=>$model->user_id));
				elseif(isset($_POST['yt1']))
					$this->redirect(array('/calendar/view/index'));
			}
		}

		$this->render('_form',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model = System::loadModel('UserService', $id);

		if(isset($_POST['UserService']))
		{
			$model->attributes=$_POST['UserService'];
			if($model->view_in_calendar == 1)
				$model->scenario = 'add_to_calendar';
			if($model->save()) {
				if(isset($_POST['yt0']))
					$this->redirect(array('/user/admin/view', 'id'=>$model->user_id));
				elseif(isset($_POST['yt1']))
					$this->redirect(array('/calendar/view/index'));
			}
		}

		$this->render('_form',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$model = System::loadModel('UserService', $id);
		$model->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Manages all models.
	 */
	public function actionManage($id)
	{
		
		$service= new UserService('search');
		$service->unsetAttributes();  // clear any default values
		
		if(isset($_GET['UserService']))
			$service->attributes=$_GET['UserService'];
		
		$service->user_id = $id;
		
		$this->render('manage',array(
			'service'=>$service,
		));
	}
	

	
}
