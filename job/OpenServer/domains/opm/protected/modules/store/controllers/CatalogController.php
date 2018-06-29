<?php

class CatalogController extends Controller
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
				'actions'=>array('view', 'index'),
				'users'=>array('*'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete', 'create','update', 'seo'),
				'roles'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	
	public function titles(){
		switch(Yii::app()->controller->action->id){
			case 'index':
				return Yii::t('main', 'OPM Products');
				break;
					
			case 'create':
				return Yii::t('shop', 'Create catalog');
				break;
					
			case 'update':
				return Yii::t('shop', 'Edit catalog');
				break;
					
			case 'admin':
				return Yii::t('shop', 'Manage catalogs');
				break;
					
			case 'seo':
				return Yii::t('shop', 'Catalog SEO');
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
		$this->layout='//layouts/templates/store';
		$model = System::loadModel('Catalog', null, $url);
		
		$this->seo($model->seo_title, $model->seo_keywords, $model->seo_description, $model->name);
		JS::add('page_styles', 'pageStyles('.Yii::app()->getModule('store')->productPerRow.');');
			
		$condition = "is_view = 1 AND catalog_id =".$model->id."";
			
		$dataProvider = new CActiveDataProvider('Product',
			array(
				'criteria'=>array(
				'with'=>array('product_c'),
				"condition"=>$condition,
				'order'=>'position, name, date DESC',
				'group'=>'t.id',
				'together'=>true,
			),
			'pagination'=>array(
				'pageSize'=>Yii::app()->getModule('store')->itemsPerPage,
			),
		));
			
		$this->ajaxRender('view',array(
			'model'=>$model,
			'dataProvider'=> $dataProvider,
		));
	}
	
	public function actionIndex()
	{
		$this->layout='//layouts/templates/store';
		
		
		$dataProvider = new CActiveDataProvider('Product',
			array(
				'criteria'=>array(
				"condition"=>'is_view = 1',
				'order'=>'position, name, date DESC',
				'group'=>'t.id',
			),
			'pagination'=>array(
				'pageSize'=>Yii::app()->getModule('store')->itemsPerPage,
			),
		));		
		JS::add('page_styles', 'pageStyles('.Yii::app()->getModule('store')->productPerRow.');');
		$this->ajaxRender('index',array(
			'dataProvider'=> $dataProvider,
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Catalog;

		if(isset($_POST['Catalog']))
		{
			$model->attributes=$_POST['Catalog'];
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
		$model= System::loadModel('Catalog', $id);

		if(isset($_POST['Catalog']))
		{
			$model->attributes=$_POST['Catalog'];
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
		$model = System::loadModel('Catalog', $id);
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
		$model=new Catalog('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Catalog']))
			$model->attributes=$_GET['Catalog'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	
	
}
