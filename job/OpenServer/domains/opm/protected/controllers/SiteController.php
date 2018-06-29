<?php

class SiteController extends Controller
{
	public $layout = '//layouts/templates/site';
	/**
	 * Declares class-based actions.
	 */
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
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		$this->layout = '//layouts/templates/admin';
		if(Yii::app()->user->isGuest)
			$this->redirect(array('/user/login'));
		$this->seo('Navigation');
		$this->render('index');

	}
	
	
	public function actionFront()
	{
		$this->layout = '//layouts/site';
		Yii::import('application.modules.page.models.Content');
		$model = System::loadModel('Content', 1);
		$this->render('front', array('model'=>$model));
	
	}
	
	public function actionGallery()
	{
		$this->layout='//layouts/templates/trade';
		Yii::app()->clientScript->registerPackage('swipebox');
		Yii::app()->clientScript->registerPackage('lazy');
		Yii::import('application.modules.page.models.Content');
		$model = System::loadModel('Content', 6);
		$this->seo($model->seo_title, $model->seo_keywords, $model->seo_description, $model->name);
		
		$this->render('gallery', array('model'=>$model));
	
	}
	
	public function actionTest(){
		Yii::import('application.modules.invoice.models.*');
		Yii::import('application.modules.video.models.*');
		Yii::import('application.modules.invoice.components.*');
				
		$invoice = Invoice::model()->findByPk(355);
			
		if($invoice !== null) {
			$code = new VideoCodes();
			$code->user_id = $invoice->user_id;
			$code->video_id = $invoice->model_id;
			$code->invoice_id = $invoice->id;
			$code->create_date = date('Y-m-d');
			$code->code = cText::cropStr(md5(date('Ymdhsi')), 10);
			$code->save();
			
			$link = Yii::app()->createAbsoluteUrl('video/view/client', array('code'=>$code->code));
			$userData = array('link'=>'<a target = "_blank" href = "'.$link.'">'.$link.'</a>', 'name'=>$invoice->name);
			Email::send('video_user_access', $userData, $invoice->name, $invoice->email);
				
			$link = Yii::app()->createAbsoluteUrl('user/admin/view', array('id'=>$invoice->user_id));
			$invoiceLink = Yii::app()->createAbsoluteUrl('invoice/view/update', array('id'=>$invoice->id));
			$adminData = array('name'=>'<a target = "_blank" href = "'.$link.'">'.$invoice->name.'</a>', 'link'=>$invoiceLink);
				
			Email::send('video_admin_message', $adminData);
			
		}
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			$this->seo($error['message']);
			
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			elseif($error['code']==404) {
				$this->layout = '//layouts/error';
				$this->render('application.views.site.errors.'.$error['code'], $error);
			}			
			else	
				$this->render('error', array('error'=>$error));
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$this->layout = '//layouts/templates/trade';
		Yii::import('application.modules.page.models.Content');
		$content = System::loadModel('Content', 5);
		$this->seo($content->seo_title, $content->seo_keywords, $content->seo_description, $content->name);
		
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate()){
				$flash = Email::send('contact_form', $model->attributes);
				Yii::app()->user->setFlash('contact', $flash);
				$this->refresh();
			}
		}
		$this->render('contact', array('model'=>$model, 'content'=>$content));
	}
	
	public function actionQuick($type){
		$data = $this->getTypes($type);
		$this->seo($data['name']);
		$this->layout = '//layouts/site';
		Yii::import('application.modules.user.models.*');
		$model = new QuickRegistration;
		
		if(isset($_POST['QuickRegistration'])) {
			$model->attributes = $_POST['QuickRegistration'];
						
			if($model->validate())	{
				User::model()->saveUser($model->attributes, $data['types']);
				Email::send($data['template'], array(), $model->firstname.' '.$model->lastname, $model->email);
				$flash = Email::send($data['template'], $model->attributes);
				Yii::app()->user->setFlash('registration_success', $flash);
				$this->refresh();
			}
		}
		
		$this->render('quick_registration', array('model'=>$model));
	}
	
	
	protected function getTypes($type) {
		switch($type){
			case 1:
				return array('name'=>'RECEIVE A GIFT', 'template'=>'registration_get_gift', 'types'=>[6]);
				break;
					
			case 2:
				return array('name'=>'GET A FREE RETOUCH', 'template'=>'registration_free_retouch', 'types'=>[5]);
				break;
					
			case 3:
				return array('name'=>'GET A TRAINING COURSE', 'template'=>'registration_training_course', 'types'=>[7]);
				break;
					
		}
	}
}