<?php

class HistoryController extends Controller
{
	/**
	 * @var string the default layout for the views
	 */
	public $layout='//layouts/templates/admin';
	
	public $defaultAction = 'admin';
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
				'actions'=>array('update', 'admin','delete', 'changeStatus'),
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
				return Yii::t('admin', 'Create');
				break;
			case 'invoice':
				return Yii::t('admin', 'Invoice');
				break;
			case 'updateInvoice':
				return Yii::t('admin', 'Update Invoice History');
				break;
					
			case 'admin':
				return Yii::t('shop', 'Purchase History');
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
		$model = System::loadModel('ProdHistory', $id, null);		
		$this->seo(Yii::t('shop', 'Order - ').$model->order_code);
		
		$this->render('view',array(
			'model'=>$model,
		));
	}
	
	public function actionChangeStatus() {
		$code = Yii::app()->request->getParam('code');
		$status = Yii::app()->request->getParam('status');
		if(Yii::app()->request->isAjaxRequest)
			ProdHistory::model()->updateAll(array('status'=>$status), 'order_code=:code', array(':code'=>$code));
	}
	

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$model = System::loadModel('ProdHistory', $id);
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
		$model=new ProdHistory('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ProdHistory']))
			$model->attributes=$_GET['ProdHistory'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	
}
