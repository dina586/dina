<?php

class ViewController extends Controller
{

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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('view'),
				'users'=>array('*'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('create','update', 'admin', 'seo'),
				'roles'=>array('admin'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('delete'),
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
	
	protected function beforeAction($event)
	{
		$this->seo($this->titles());
		return true;
	}
	
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($url)
	{	
		$model = System::loadModel('Content', null, $url);
		$this->layout='//layouts/templates/content';
		
		
		$this->seo($model->seo_title, $model->seo_keywords, $model->seo_description, $model->name);
		
		$this->render('helper_view.parts.global.view',array(
			'model'=>$model,
		));
	}
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Content;

		if(isset($_POST['Content']))
		{
			$model->attributes=$_POST['Content'];
			if($model->save())
				$this->redirect(array('view','url'=>$model->url));
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
		$model = System::loadModel('Content', $id);

		if(isset($_POST['Content']))
		{
			$model->attributes=$_POST['Content'];
			if($model->save())
				if($model->id == 6)
					$this->redirect(array('/site/gallery'));
				else
					$this->redirect(array('view','url'=>$model->url));
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
		$model = System::loadModel('Content', $id);
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
		$model=new Content('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Content']))
			$model->attributes=$_GET['Content'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	
}
