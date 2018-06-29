<?php

class InvoiceController extends Controller
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
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('confirm', 'clientPay'),
				'users'=>array('*'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('manage', 'pay'),
				'roles'=>array('user'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	
	public function titles(){
		switch(Yii::app()->controller->action->id){
			case 'manage':
				return Yii::t('admin', 'Invoices');
				break;
		
			case 'pay':
				return Yii::t('admin', 'Choose payment system');
				break;
			case 'clientPay':
				return Yii::t('admin', 'Choose payment system');
				break;
		
		}
	}
	
	protected function beforeAction($event)
	{
		$this->seo($this->titles());
		return true;
	}
	
	public function actionConfirm(){
		if(isset($_POST) && $_POST['x_response_code']==1)
			Invoice::model()->updateByPk($_POST['x_invoice_num'], array('status'=>1));
		$this->renderPartial('confirm');
	}
	
	/**
	 * Инвойсы пользователя
	 */
	public function actionManage($id)
	{
		
		if (isset($_GET['pageSize'])) {
			Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
			unset($_GET['pageSize']);
		}
		$user = System::loadModel('User', $id);
		$this->seo('Invoices for '.$user->profile->firstname.' '.$user->profile->lastname);
		$model = new Invoice('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Invoice']))
			$model->attributes=$_GET['Invoice'];
		
		$this->render('manage',array(
			'model'=>$model,
		));
	}
	
	public function actionPay($id)
	{
		$model = System::loadModel('Invoice', $id);
		$user = System::loadModel('User', $model->user_id);
	
		$this->render('pay',array(
			'model'=>$model,
			'user'=>$user,
		));
	}
	
	public function actionClientPay($type){
		$this->layout='//layouts/site';
		if(!Yii::app()->user->getState($type.'_invoice'))
			$this->redirect(array('/video/view/index'));
		else
			$data = Yii::app()->user->getState($type.'_invoice');
		$this->render('application.modules.store.views.cart.pay', array('data'=>$data));
	}
	
	public function actionClientConfirm($type) {
		
	}
	
}
