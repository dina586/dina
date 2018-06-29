<?php

class SettingsController extends Controller
{
	/**
	 * @var string the default layout for the views
	 */
	//public $layout='//layouts/templates/admin';

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
				'actions'=>array('update', 'admin'),
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
				return Yii::t('admin', 'Create new setting');
				break;
					
			case 'update':
				return Yii::t('admin', 'Edit settings');
				break;
					
			case 'admin':
				return Yii::t('admin', 'Manage site settings');
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
		$model=new Settings;

		if(isset($_POST['Settings']))
		{
			$model->attributes=$_POST['Settings'];
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
		$model = System::loadModel('Settings', $id);
		
		if(!Yii::app()->user->checkAccess($model->visible))
			throw new CHttpException(403, Yii::t('main', 'Access denied'));
		
		if(isset($_POST['Settings']))
		{
			$model->attributes=$_POST['Settings'];
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
		$model = System::loadModel('Settings', $id);
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
		$model=new Settings('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Settings']))
			$model->attributes=$_GET['Settings'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	
	protected  function getField($type, $model, $form, $attribute = 'value') {
		switch($type){
			case 'input': 
				return $form->textFieldControlGroup($model,$attribute);
			case 'textarea':
				return $form->textAreaControlGroup($model,$attribute);
			case 'editor':
				return Fields::editor($model, $form, $attribute);
			default: return $form->textFieldControlGroup($model,$attribute);
		}
	}
}
