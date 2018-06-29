<?php

class FrontController extends Controller
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
			array('allow', // allow admin
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
				return Yii::t('admin', 'Добавить новый слайд');
				break;
					
			case 'update':
				return Yii::t('admin', 'Редактирование слайда');
				break;
					
			case 'admin':
				return Yii::t('admin', 'Управление слайдером');
				break;

		}
	}
	
	protected function beforeAction($event)
	{
		$this->seo(Helper::seoPage($this->titles(), 'FrontSlider_page'), '', Helper::seoPage($this->titles(), 'FrontSlider_page'));
		return true;
	}


	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new FrontSlider;

		if(isset($_POST['FrontSlider']))
		{
			$model->attributes=$_POST['FrontSlider'];
			
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
		$model = System::loadModel('FrontSlider', $id);

		if(isset($_POST['FrontSlider']))
		{
			$model->attributes=$_POST['FrontSlider'];
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
		$model = System::loadModel('FrontSlider', $id);
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
		$model=new FrontSlider('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['FrontSlider']))
			$model->attributes=$_GET['FrontSlider'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

}
