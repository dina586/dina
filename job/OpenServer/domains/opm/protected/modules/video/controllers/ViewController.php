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
			array('allow',  // allow all
				'actions'=>array('index','preview', 'see', 'getAccess', 'pay', 'confirm', 'client'),
				'users'=>array('*'),
			),
			array('allow', // allow admin
				'actions'=>array('create','update', 'admin','delete', 'seo', 'view'),
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
				return Yii::t('admin', 'Add new video');
				break;
					
			case 'update':
				return Yii::t('admin', 'Edit video');
				break;
					
			case 'admin':
				return Yii::t('admin', 'Manage videos');
				break;
			
			case 'seo':
				return Yii::t('admin', 'Manage SEO');
				break;
			
			case 'index':
				return Yii::t('admin', 'Video');
				break;
				
			case 'getAccess':
				return Yii::t('admin', 'Video access');
				break;
			case 'pay':
				return Yii::t('admin', 'Pay access');
				break;
		}
	}
	
	public function beforeAction($event)
	{
		$this->seo(Helper::seoPage($this->titles(), 'Video_page'), '', Helper::seoPage($this->titles(), 'Video_page'));
		return true;
	}
	
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->layout='//layouts/site';
		
		$model = System::loadModel('Video', $id);		
		$this->seo($model->name);
		
		$this->render('view',array(
			'model'=>$model,
		));
	}
	
	public function actionClient($code)
	{
		
		$this->layout='//layouts/site';
		
		$c = VideoCodes::model()->find('code=:code', array(':code'=>$code));
		
		if($c === null)
			throw new CHttpException(403, 'Something error with your link. Pleace, check it one more time!');
		
		$date = new DateTime($c->create_date);
		
		$date->modify('+30 days');
		$expireDate = $date->format('Y-m-d');
		
		if($expireDate < date('Y-m-d'))
			throw new CHttpException(404, 'Your video code access has been expired. You can order the next video or a live training course.');
		
		$model = System::loadModel('Video', $c->video_id);		
		$this->seo($model->name);
		
		$this->render('view',array(
			'model'=>$model,
		));
		
	}
	
	public function actionGetAccess($n)
	{
		Yii::import('application.modules.invoice.models.*');
		Yii::import('application.modules.invoice.components.*');
		$this->layout='//layouts/site';
		
		$model = System::loadModel('Video', $n);		
		$registration = new QuickRegistration();
		
		if(Yii::app()->user->getState('video_order'))
			$registration->attributes = Yii::app()->user->getState('video_order');
		
		if(isset($_POST['QuickRegistration']))
		{
				
			$registration->attributes = $_POST['QuickRegistration'];
							
			if($registration->validate())	{
				Yii::app()->user->setState('video_order', $registration->attributes);
				
				$userId = User::model()->saveUser($registration->attributes, 12);
				
				$p = $registration->attributes;
				
				if(Yii::app()->user->getState('video_invoice_id'))
					$p['invoice_num'] = Yii::app()->user->getState('video_invoice_id');
				else
					$p['invoice_num'] = false;
				
				//Создаем инвойс
				$invoice = new InvoiceHelper();
				$invoice ->userId= $userId;
				$invoice->type = 3;
				$invoice->items[] = array('name'=>$model->name, 'price'=>$model->price, 'qty'=>1);
				$invoice->subtotal = $model->price;
								
				$p['invoice_num'] = $invoice->saveInvoice($p['invoice_num']);

				Yii::app()->user->setState('video_invoice_id', $p['invoice_num']);
				
				//Записываем данные для аутсориза
				
				$p['total_cost'] = $model->price;
				$p['description'] = 'Video access purcase';
				$p['relay_url'] = Yii::app()->createAbsoluteUrl('video/view/confirm');
				$p['cancel_url'] = Yii::app()->createAbsoluteUrl('video/view/getAccess', array('n'=>$model->id));				
				$p['first_name'] =  $registration ->firstname;
				$p['last_name'] =  $registration -> lastname;

				Yii::app()->user->setState('video_invoice', $p);
				
				$this->redirect(array('/invoice/invoice/clientPay', 'type'=>'video'));
			}
		}
				
		$this->render('access',array(
			'model'=>$model,
			'order'=>$registration,
		));
	}
	
	public function actionConfirm() {
		if(isset($_POST)) {
				
			Yii::import('application.modules.invoice.models.*');
			Yii::import('application.modules.video.models.*');
			Yii::import('application.modules.invoice.components.*');
				
			$invoice = Invoice::model()->findByPk($_POST['x_invoice_num']);
			
			if($invoice !== null) {
				$code = new VideoCodes();
				$code->user_id = $invoice->user_id;
				$code->video_id = $invoice->model_id;
				$code->invoice_id = $invoice->id;
				$code->create_date = date('Y-m-d');
				$code->code = cText::cropStr(md5(date('Ymdhsi')), 10);
				$code->save();
				
				Invoice::model()->updateByPk($_POST['x_invoice_num'], array('status'=>1, 'model_id'=>$code->id));
				
				$link = Yii::app()->createAbsoluteUrl('video/view/client', array('code'=>$code->code));
				$userData = array('link'=>'<a target = "_blank" href = "'.$link.'">'.$link.'</a>', 'name'=>$invoice->name);
				Email::send('video_user_access', $userData, $invoice->name, $invoice->email);
					
				$link = Yii::app()->createAbsoluteUrl('user/admin/view', array('id'=>$invoice->user_id));
				$invoiceLink = Yii::app()->createAbsoluteUrl('invoice/view/update', array('id'=>$invoice->id));
				$adminData = array('name'=>'<a target = "_blank" href = "'.$link.'">'.$invoice->name.'</a>', 'link'=>$invoiceLink);
					
				Email::send('video_admin_message', $adminData);
			}
		}
		
		$this->renderPartial('application.modules.invoice.views.invoice.confirm');
	}
	
	public function actionPay(){
		$this->layout='//layouts/site';
		if(!Yii::app()->user->getState('video_order'))
			$this->redirect(array('/video/view/index'));
		else
			$data = Yii::app()->user->getState('video_order');
		$this->render('application.modules.store.views.cart.pay', array('data'=>$data));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Video;

		if(isset($_POST['Video']))
		{
			$model->attributes=$_POST['Video'];
			
			if($model->save())
				$this->redirect(array('view', 'id'=>$model->id));
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
		$model = System::loadModel('Video', $id);
	
		if(isset($_POST['Video']))
		{
			
			$model->attributes=$_POST['Video'];
			if($model->save())
				$this->redirect(array('view', 'id'=>$model->id));
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
		$model = System::loadModel('Video', $id);
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
		
		$dataProvider=new CActiveDataProvider('Video', array(
			'criteria'=>array(
				"condition"=>"is_view = 1",
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

	public function actionPreview()
	{
		if(!Yii::app()->request->isAjaxRequest) {
			$this->redirect('/site/front');
		}
		
		$model = System::loadModel('Video', Yii::app()->request->getParam('id'));
		echo $model->tutorial_code;
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
		$model=new Video('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Video']))
			$model->attributes=$_GET['Video'];

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
		$model=new Video('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Video']))
			$model->attributes=$_GET['Video'];
		
		$this->render('helper_view.parts.global.seo',array(
			'model'=>$model,
		));
	}
}
