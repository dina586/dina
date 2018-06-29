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
	public function actions()
	{
		return array(
			'captcha'=>array(
				'class'=>'CaptchaExtendedAction',
				// if needed, modify settings
				'mode'=>CaptchaExtendedAction::MODE_MATH,
			),
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
			array('allow',  // allow all
				'actions'=>array('index','view', 'captcha'),
				'users'=>array('*'),
			),
			array('allow', // allow admin
				'actions'=>array('create','update', 'admin','delete', 'seo'),
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
				return Yii::t('admin', 'Добавить новый отзыв');
				break;
					
			case 'update':
				return Yii::t('admin', 'Редактирование отзыва');
				break;
					
			case 'admin':
				return Yii::t('admin', 'Отзывы');
				break;
			
			case 'seo':
				return Yii::t('admin', 'Manage SEO');
				break;
			
			case 'index':
				return Yii::t('admin', 'Отзывы');
				break;
		}
	}
	
	public function beforeAction($event)
	{
		$this->seo(Helper::seoPage($this->titles(), 'Opinion_page'), '', Helper::seoPage($this->titles(), 'Opinion_page'));
		return true;
	}
	
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Opinion;

		if(isset($_POST['Opinion']))
		{
			$model->attributes=$_POST['Opinion'];
			
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
		$model = System::loadModel('Opinion', $id);

		if(isset($_POST['Opinion']))
		{
			$model->attributes=$_POST['Opinion'];
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
		$model = System::loadModel('Opinion', $id);
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
		
		$dataProvider=new CActiveDataProvider('Opinion', array(
			'criteria'=>array(
				"condition"=>"is_view = 1 AND is_new = 0",
				'order'=>'create_date DESC, id DESC',
			),
			'pagination'=>array(
				'pageSize'=>7,
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
		$model=new Opinion('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Opinion']))
			$model->attributes=$_GET['Opinion'];

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
		$model=new Opinion('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Opinion']))
			$model->attributes=$_GET['Opinion'];
		
		$this->render('helper_view.parts.global.seo',array(
			'model'=>$model,
		));
	}
}
