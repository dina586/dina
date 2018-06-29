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
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update', 'admin','delete'),
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
				return Yii::t('admin', 'Создать новую технику');
				break;
					
			case 'update':
				return Yii::t('admin', 'Редактировать технику');
				break;
					
			case 'admin':
				return Yii::t('admin', 'Управление техниками');
				break;
			
			case 'seo':
				return Yii::t('admin', 'Manage SEO');
				break;
			
			case 'index':
				return Yii::t('admin', 'Техники');
				break;
		}
	}
	
	public function beforeAction($event)
	{
		$this->seo(Helper::seoPage($this->titles(), 'Technics_page'), '', Helper::seoPage($this->titles(), 'Technics_page'));
		return true;
	}
	
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($url)
	{
		$this->layout='//layouts/templates/base';
		$model = System::loadModel('Technics', null, $url);		
		$this->seo($model->seo_title, $model->seo_keywords, $model->seo_description, $model->name);
		
		$this->render('view',array(
			'model'=>$model,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Technics;

		if(isset($_POST['Technics']))
		{
			$model->attributes=$_POST['Technics'];
			
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
		$model = System::loadModel('Technics', $id);

		if(isset($_POST['Technics']))
		{
			$model->attributes=$_POST['Technics'];
			if($model->save())
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
		$model = System::loadModel('Technics', $id);
		$model->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$this->layout='//layouts/templates/base';
		
		Yii::import('application.modules.page.models.Content');
		$content = System::loadModel('Content', 6);
		
		$dataProvider=new CActiveDataProvider('Technics', array(
			'criteria'=>array(
				"condition"=>"is_view = 1",
				'order'=>'date DESC, id DESC',
			),
			'pagination'=>array(
				'pageSize'=>10,
			),
		));
		
		$this->render('index',array(
			'dataProvider'=>$dataProvider, 'content' => $content,
		));
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
		$model=new Technics('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Technics']))
			$model->attributes=$_GET['Technics'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	
	
	public function actionSeo()
	{
		if (isset($_GET['pageSize'])) {
			Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
			unset($_GET['pageSize']);
		}
		$model=new Technics('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Technics']))
			$model->attributes=$_GET['Technics'];
		
		$this->render('helper_view.parts.global.seo',array(
			'model'=>$model,
		));
	}
}
