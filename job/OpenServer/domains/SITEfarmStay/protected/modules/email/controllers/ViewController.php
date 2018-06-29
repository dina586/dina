<?php

class ViewController extends Controller
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

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('update', 'admin', 'sendTest'),
				'roles'=>array('admin'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create', 'delete'),
				'roles'=>array('developer'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	
	public function titles(){
		switch(Yii::app()->controller->action->id){
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
	
	public function beforeAction($event)
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
		$model=new EmailMessage;

		if(isset($_POST['EmailMessage']))
		{
			$model->attributes=$_POST['EmailMessage'];
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
		$model = System::loadModel('EmailMessage', $id);
		
		if(!Yii::app()->request->isAjaxRequest)
			Yii::app()->clientScript->registerPackage('ajaxForm');
		
		if(isset($_POST['EmailMessage']))
		{
			$model->attributes=$_POST['EmailMessage'];
			if($model->save())
				$this->redirect(array('admin'));
		}

		$this->render('_form',array(
			'model'=>$model,
		));
	}
	
	public function actionSendTest($id)
	{
		$model = System::loadModel('EmailMessage', $id);

		if(!Yii::app()->request->isAjaxRequest)
			throw new CHttpException(403, Yii::t('admin', 'Access denied'));
		
		if(isset($_POST['EmailMessage']))
		{
			$model->attributes=$_POST['EmailMessage'];
			echo Email::sendTest($model).'<br/>'.Yii::t('admin', 'Do not forget to click "Save" to save your changes!');
		}

	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$model = System::loadModel('EmailMessage', $id);
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
		$model=new EmailMessage('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['EmailMessage']))
			$model->attributes=$_GET['EmailMessage'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	
}
