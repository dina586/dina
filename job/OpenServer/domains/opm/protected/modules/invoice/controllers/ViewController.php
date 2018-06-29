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
				'actions'=>array('view', 'getUser', 'getUserData'),
				'users'=>array('*'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('create','update', 'admin', 'delete', 'autocomplete'),
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
				return Yii::t('admin', 'Create new invoice');
				break;
					
			case 'update':
				return Yii::t('admin', 'Edit invoice');
				break;
					
			case 'admin':
				return Yii::t('admin', 'Manage Invoices');
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
	public function actionView($id)
	{	
		//if(DEV_MODE===true)
			error_reporting(E_ALL^E_DEPRECATED);
		$model = System::loadModel('Invoice', $id);
		$this->seo('Invoice-'.$model->id);
		
		$data = $this->renderPartial('view', array('model'=>$model), true);
		$mPDF1 = Yii::app()->ePdf->mpdf('', 'Letter');
		$stylesheet = utf8_encode(file_get_contents(Yii::getPathOfAlias('webroot').DS.'css'.DS.'store_invoice.css'));
		$mPDF1->WriteHTML($stylesheet,1);
		$mPDF1->WriteHTML($data);
		$mPDF1->Output(Translit::asURLSegment('invoice-'.$model->id).'.pdf', 'I');
	}
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Invoice;
		$model->tax_percent = Settings::getVal('tax');
		$model->status = 0;
		$model->invoice_type = 1;
		
		if(isset($_POST['Invoice']))
		{
			$model->attributes=$_POST['Invoice'];
			if($model->save())
				$this->stepRedirect($model);
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
		$model = System::loadModel('Invoice', $id);

		if(isset($_POST['Invoice']))
		{
			$model->attributes=$_POST['Invoice'];
			if($model->save())
				$this->stepRedirect($model);
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
		$model = System::loadModel('Invoice', $id);
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
		if(!Yii::app()->request->isAjaxRequest)
			Yii::app()->clientScript->registerPackage('invoice_module');
		$model=new Invoice('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Invoice']))
			$model->attributes=$_GET['Invoice'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	
	public function actionGetUser()
	{
		if(isset($_GET['q']) && ($keyword=trim($_GET['q']))!=='') {
			$tags = Profile::model()->findAll(array(
				'condition'=>'CONCAT(firstname, " ", lastname) LIKE :keyword AND roles.role != "developer" AND roles.role != "admin"',
				'order'=>'firstname',
				'distinct'=>true,
				'select'=>'firstname, lastname',
				'limit'=>50,
				'with'=>array('roles'),
				'params'=>array(
					':keyword'=>'%'.strtr($keyword,array('%'=>'\%', '_'=>'\_', '\\'=>'\\\\')).'%',
				),
			));
		
		$names=array();
			foreach($tags as $tag)
				$names[]= $tag->firstname.' '.$tag->lastname;
	
			if($names!==array())
				echo implode("\n",$names);
		}
	}
	

	public function actionGetUserData() {
		$userName = Yii::app()->request->getParam('user');
		$model = User::model()->with('profile')->find(
			array(
				'condition'=>'CONCAT(profile.firstname, " ", profile.lastname) LIKE :user',
				'params'=>array(
					':user'=>$userName,
				),
				'order'=>'profile.firstname',
			)
		);
		if($model !== null) {
			$json = array(
				'status'=>'ok',
				'data'=>array(
					'name'=>$model->profile->firstname.' '.$model->profile->lastname,
					'email'=>$model->email,
					'user_id'=>$model->id,
					'phone'=>$model->profile->mobile,
					'address'=>Helper::viewAddress($model->profile),
				)
			);
		}
		else
			$json = array(
				'status'=>'error',
			);
		echo json_encode($json);
		
	}
	
	public function actionAutocomplete($type) {
		
		$models = array();
		if(isset($_GET['term']) && ($keyword=trim($_GET['term']))!=='') {
			Yii::import('application.modules.invoice.components.InvoiceAutocomplete');
			$autocomplete = new InvoiceAutocomplete();
			echo $autocomplete->init(Yii::app()->request->getParam('type'), $keyword);
			
		}
		
	}
	
	public function stepRedirect($model){
		if(isset($_POST['yt0']))
			$this->redirect(array('admin'));
		elseif(isset($_POST['yt1']))
			$this->redirect(array('/invoice/view/view', 'id'=>$model->id));
		else
			$this->redirect(array('/invoice/invoice/pay', 'id'=>$model->id));
	}
}
