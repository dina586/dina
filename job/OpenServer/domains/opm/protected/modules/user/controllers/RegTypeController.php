<?php

class RegTypeController extends Controller
{
	/**
	 * @var string the default layout for the views
	 */
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

	public function accessRules()
	{
		return array(
			array('allow',
				'actions'=>array('create','update', 'admin','delete', 'patch'),
				'roles'=>array('developer'),
			),
			array('deny',
				'users'=>array('*'),
			),
		);
	}
	
	public function titles(){
		switch(Yii::app()->controller->action->id){
			case 'create':
				return Yii::t('admin', 'Add new user type');
				break;
					
			case 'update':
				return Yii::t('admin', 'Edit user type');
				break;
					
			case 'admin':
				return Yii::t('admin', 'Manage user types');
				break;
		}
	}
	
	protected function beforeAction($event)
	{
		$this->seo($this->titles());
		return true;
	}
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new UserRegType;

		if(isset($_POST['UserRegType']))
		{
			$model->attributes=$_POST['UserRegType'];
			if($model->save())
				$this->redirect(array('admin'));
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
		$model = System::loadModel('UserRegType', $id);

		if(isset($_POST['UserRegType']))
		{
			$model->attributes=$_POST['UserRegType'];
			if($model->save())
				$this->redirect(array('admin'));
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
		$model = System::loadModel('UserRegType', $id);
		$model->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		if (isset($_GET['pageSize'])) {
			Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
			unset($_GET['pageSize']);
		}
		$model=new UserRegType('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['UserRegType']))
			$model->attributes=$_GET['UserRegType'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	
	public function actionPatch() {
		$profile = Profile::model()->findAll();
		foreach($profile as $m) {
			if($m->in_service_makeup == 1)
				$this->saveU ($m->user_id, 9);
			if($m->in_service_inject == 1)
				$this->saveU ($m->user_id, 10);
			if($m->in_service_laser == 1)
				$this->saveU ($m->user_id, 11);
			
			if($m->in_product == 1)
				$this->saveU ($m->user_id, 1);
			
			if($m->in_student_beggining == 1)
				$this->saveU ($m->user_id, 2);
			if($m->in_student_advanced == 1)
				$this->saveU ($m->user_id, 3);
			if($m->in_student_medical == 1)
				$this->saveU ($m->user_id, 4);
			
			if($m->in_client_services == 1)
				$this->saveU ($m->user_id, 5);
			if($m->in_client_products == 1)
				$this->saveU ($m->user_id, 6);
			if($m->in_client_training == 1)
				$this->saveU ($m->user_id, 7);
			
			if($m->in_models == 1)
				$this->saveU ($m->user_id, 8);
			
		}
	}
	
	public function saveU($userId, $serviceId){
		$m = new UserType;
		$m ->user_id = $userId;
		$m->type_id = $serviceId;
		$m->save();
	}
}
