<?php


class ProcedureController extends Controller
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
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('create','update', 'admin', 'delete', 'getProcedure', 'getPrice'),
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
				return Yii::t('admin', 'Create new Procedure');
				break;
					
			case 'update':
				return Yii::t('admin', 'Edit procedure');
				break;
					
			case 'admin':
				return Yii::t('admin', 'Manage Procedures');
				break;
		}
	}
	
	protected function beforeAction($event)
	{
		$this->seo($this->titles());
		return true;
	}
	
	
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new ServiceProcedure;

		if(isset($_POST['ServiceProcedure']))
		{
			$model->attributes=$_POST['ServiceProcedure'];
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
		$model = System::loadModel('ServiceProcedure', $id);

		if(isset($_POST['ServiceProcedure']))
		{
			$model->attributes=$_POST['ServiceProcedure'];
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
		$model = System::loadModel('ServiceProcedure', $id);
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
		$model=new ServiceProcedure('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ServiceProcedure']))
			$model->attributes=$_GET['ServiceProcedure'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	
	public function actionGetProcedure()
	{
		$serviceId = (int)Yii::app()->request->getParam('service_id');
		$name = (int)Yii::app()->request->getParam('name');
	
		if($serviceId != 0) {
			$text = 'Choose Service';
		}
		else {
			$serviceId = 1000000;
			$text = 'Choose Service First';
		}
		
		$name = str_replace('_service_id', '', Yii::app()->request->getParam('name'));
		
		echo BsHtml::dropDownList(
			$name.'[procedure_id]',
			'',
			CHtml::listData(ServiceProcedure::model()->findAll(
					array(
						'order'=>'number, name',
						'condition'=>'service_id=:service_id',
						'params'=>array(':service_id'=>$serviceId)
				)),
			'id', 'name'),
			array('empty'=>$text)
		);
	}
	
	public function actionGetPrice() {
		$id = (int)Yii::app()->request->getParam('procedure_id');
		$data = ServiceProcedure::model()->findByPk($id);
		if($data !== null)
			echo json_encode(array('price'=>$data->price, 'procedure_length'=>$data->procedure_length));
	}
}
