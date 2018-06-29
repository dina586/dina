<?php

class SettingsController extends Controller
{

	public $layout='//layouts/templates/admin';

	public function filters()
	{
		return array(
			'accessControl',
			'postOnly + delete',
		);
	}

	public function accessRules()
	{
		return array(
			array('allow',
				'actions'=>array('update', 'admin'),
				'roles'=>array('admin'),
			),
			array('allow',
				'actions'=>array('create', 'delete'),
				'roles'=>array('developer'),
			),
			array('deny',
				'users'=>array('*'),
			),
		);
	}
	
	public function titles(){
		switch(Yii::app()->controller->action->id){
			case 'create':
				return Yii::t('admin', 'Create new setting');
				break;
					
			case 'update':
				return Yii::t('admin', 'Edit settings');
				break;
					
			case 'admin':
				return Yii::t('admin', 'Manage site settings');
				break;
		}
	}
	
	public function beforeAction($event)
	{
		$this->seo($this->titles());
		return true;
	}
	
	public function actionCreate()
	{
		$model=new Settings;

		if(isset($_POST['Settings']))
		{
			$model->attributes=$_POST['Settings'];
			if($model->save())
				$this->redirect(array('admin'));
		}

		$this->render('_form',array(
			'model'=>$model,
		));
	}

	public function actionUpdate($id)
	{
		$model = System::loadModel('Settings', $id);
		
		if(!Yii::app()->user->checkAccess($model->visible))
			throw new CHttpException(403, Yii::t('main', 'Access denied'));
		
		if(isset($_POST['Settings']))
		{
			$model->attributes=$_POST['Settings'];
			if($model->save())
				$this->redirect(array('admin'));
		}

		$this->render('_form',array(
			'model'=>$model,
		));
	}

	public function actionDelete($id)
	{
		$model = System::loadModel('Settings', $id);
		$model->delete();

		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	public function actionAdmin()
	{
		if (isset($_GET['pageSize'])) {
			Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
			unset($_GET['pageSize']);
		}
		$model=new Settings('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Settings']))
			$model->attributes=$_GET['Settings'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	
	protected  function getField($type, $model, $form, $attribute = 'value') {
		switch($type){
			case 'input': 
				return $form->textFieldControlGroup($model,$attribute);
			case 'textarea':
				return $form->textAreaControlGroup($model,$attribute);
			case 'editor':
				return Fields::editor($model, $form, $attribute);
			default: return $form->textFieldControlGroup($model,$attribute);
		}
	}
}
