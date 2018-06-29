<?php

class ViewController extends Controller
{
	public $defaultAction = 'admin';
	
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
				'actions'=>array('create','update', 'admin', 'delete', 'contract'),
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
				return Yii::t('admin', 'Create new service');
				break;
					
			case 'update':
				return Yii::t('admin', 'Edit service');
				break;
					
			case 'admin':
				return Yii::t('admin', 'Manage Services');
				break;
			
			case 'contract':
				return Yii::t('admin', 'View contract');
				break;
			case 'signature':
				return Yii::t('admin', 'Add signature to contract');
				break;
					
			case 'seo':
				return Yii::t('admin', 'Services Seo');
				break;
			case 'index':
				return Yii::t('admin', 'OPM SERVICES');
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
		$this->layout='//layouts/templates/trade';
		$model = System::loadModel('Service', null, $url);	
		if($model->view_on_site == 0)
			throw new CHttpException(404, Yii::t('admin', 'The request page does not exists!'));
		$this->seo($model->seo_title, $model->seo_keywords, $model->seo_description, $model->name);
		
		$this->render('view',array(
			'model'=>$model,
		));
	}
	
	public function actionIndex()
	{
		$this->layout='//layouts/templates/trade';
	
		$dataProvider=new CActiveDataProvider('Service', array(
			'criteria'=>array(
				"condition"=>"is_view = 1 AND view_on_site = 1",
				'order'=>'position ASC, id DESC',
			),
			'pagination'=>array(
				'pageSize'=>20,
			),
		));
	
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
	
		
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Service;

		if(isset($_POST['Service']))
		{
			$model->attributes=$_POST['Service'];
			if($model->save())
				if($model->view_on_site == 1)
					$this->redirect(array('/service/view/view', 'url'=>$model->url));
				else
					$this->regirect(array('/service/view/admin'));
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
		$model = System::loadModel('Service', $id);

		if(isset($_POST['Service']))
		{
			$model->attributes=$_POST['Service'];
			if($model->save())
				if($model->view_on_site == 1)
					$this->redirect(array('/service/view/view', 'url'=>$model->url));
				else
					$this->regirect(array('/service/view/admin'));
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
		$model = System::loadModel('Service', $id);
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
		$model=new Service('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Service']))
			$model->attributes=$_GET['Service'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	
	public function actionContract($user_id, $service_id, $signature_id = '') {
		error_reporting(E_ALL ^ E_DEPRECATED);
		$this->layout = '//layouts/contract';
		
		$model = System::loadModel('User', $user_id);
		$service = System::loadModel('Service', $service_id);
		$signature = System::loadModel('UserService', $signature_id);
		$doc = Yii::app()->controller->getModule('service')->contract[1];
		
		
		$data = $this->render('application.modules.service.contract_templates.'.$service->contract, array('model'=>$model, 'signature'=>$signature), true);
		$mPDF1 = Yii::app()->ePdf->mpdf('', 'Letter');
		$stylesheet = utf8_encode(file_get_contents(Yii::getPathOfAlias('webroot').DS.'css'.DS.'contract.css'));
		$mPDF1->WriteHTML($stylesheet,1);
		$mPDF1->WriteHTML($data);
		
		$mPDF1->Output(Translit::asURLSegment($doc.'-for-'.$model->profile->lastname.'-'.$model->profile->firstname).'.pdf', 'I');
	}

	
}
