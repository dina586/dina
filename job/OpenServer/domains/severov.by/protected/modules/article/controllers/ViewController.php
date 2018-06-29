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
				return Yii::t('admin', 'Создать статью');
				break;
					
			case 'update':
				return Yii::t('admin', 'Редактировать статью');
				break;
					
			case 'admin':
				return Yii::t('admin', 'Управление статьями');
				break;
			
			case 'seo':
				return Yii::t('admin', 'Manage SEO');
				break;
			
			case 'index':
				return Yii::t('admin', 'Статьи');
				break;
		}
	}
	
	protected function beforeAction($event)
	{
		$this->seo(Helper::seoPage($this->titles(), 'Article_page'), '', Helper::seoPage($this->titles(), 'Article_page'));
		return true;
	}
	
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($url)
	{
		$this->layout='//layouts/templates/front_page';
		$model = System::loadModel('Article', null, $url);		
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
		$model=new Article;

		if(isset($_POST['Article']))
		{
			$model->attributes=$_POST['Article'];
			
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
		$model = System::loadModel('Article', $id);

		if(isset($_POST['Article']))
		{
			$model->attributes=$_POST['Article'];
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
		$model = System::loadModel('Article', $id);
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
		
		$dataProvider=new CActiveDataProvider('Article', array(
			'criteria'=>array(
				"condition"=>"is_view = 1",
				'order'=>'date DESC, id DESC',
			),
			'pagination'=>array(
				'pageSize'=>10,
			),
		));
		
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
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
		$model=new Article('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Article']))
			$model->attributes=$_GET['Article'];

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
		$model=new Article('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Article']))
			$model->attributes=$_GET['Article'];
		
		$this->render('helper_view.parts.global.seo',array(
			'model'=>$model,
		));
	}
}
