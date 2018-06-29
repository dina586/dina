<?php

class ProductController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/templates/admin';
	public $pageSize = 16;
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
	
	public function titles(){
		switch(Yii::app()->controller->action->id){
			case 'index':
				return Yii::t('main','Catalog');
				break;
					
			case 'create':
				return Yii::t('shop', 'Add new product');
				break;
					
			case 'update':
				return Yii::t('shop', 'Edit product');
				break;
					
			case 'admin':
				return Yii::t('shop', 'Manage products');
				break;
			case 'seo':
				return Yii::t('shop', 'Manage SEO');
				break;
		}
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
				'actions'=>array('index','view', 'seller', 'gifts', 'makeup'),
				'users'=>array('*'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin', 'create', 'update', 'delete', 'upload', 'cover', 'imgDelete', 'seo', 'exel'),
				'roles'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
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
		$this->layout='//layouts/templates/store';
		$model = System::loadModel('Product', null, $url);		
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
		$model = new Product;

		if(isset($_POST['Product']))
		{
			$model->attributes=$_POST['Product'];
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
		$model = System::loadModel('Product', $id);

		if(isset($_POST['Product']))
		{
			$model->attributes=$_POST['Product'];
			
			if($model->save()) {
				$this->redirect(array('admin'));
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
		$model = System::loadModel('Product', $id);
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
		$this->layout='//layouts/site';
		JS::add('page_styles', 'pageStyles('.Yii::app()->getModule('store')->productPerRow.');');

		$dataProvider = new CActiveDataProvider('Product',
			array(
				'criteria'=>array(
				"condition"=>'is_view = 1',
				'order'=>'position, date DESC',
				'group'=>'t.id',
			),
			'pagination'=>array(
				'pageSize'=>$this->pageSize,
			),
		));
		
		$this->ajaxRender('index',array(
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
		$model= new Product('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Product']))
			$model->attributes=$_GET['Product'];

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
		$model=new Product('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Product']))
			$model->attributes=$_GET['Product'];
		
		$this->render('helper_view.parts.global.seo',array(
			'model'=>$model,
		));
	}
	
	
}
