<?php

/**
 * @author Nicholas Kobets <wemadefoxnever@gmail.com>
 * @copyright 365-solutions.com
 * @license http://365-solutions.com/general-license
 */
class ViewController extends Controller
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
			['allow',
				'actions'=>['index','view'],
				'users'=>array('*'),
			],
			['allow',
				'actions'=>['create','update', 'admin','delete'],
				'roles'=>['admin'],
			],
			['deny',
				'users'=>['*'],
			],
		);
	}
	
	public function titles(){
		switch(Yii::app()->controller->action->id){
			case 'create':
				return Yii::t('admin', 'Добавить запись');
				break;
					
			case 'update':
				return Yii::t('admin', 'Редактирование');
				break;
					
			case 'admin':
				return Yii::t('admin', 'Блок с дизайном');
				break;
		}
	}
	
	protected function beforeAction($event)
	{
		$this->seo(Helper::seoPage($this->titles(), 'Design_page'), '', Helper::seoPage($this->titles(), 'Design_page'));
		return true;
	}
	
	public function actionView($id)
	{
		$this->layout='//layouts/templates/base';
		$model = System::loadModel('Design', $id);
		
		$this->seo($model->name);
		
		$this->render('application.views.layouts.global.view',array(
			'model'=>$model,
		));
	}

	public function actionCreate()
	{
		$model=new Design;

		if(isset($_POST['Design']))
		{
			$model->attributes=$_POST['Design'];
			if($model->save())
				$this->redirect(['admin']);
		}

		$this->render('_form',array(
			'model'=>$model,
		));
	}

	public function actionUpdate($id)
	{
		$model = System::loadModel('Design', $id);

		if(isset($_POST['Design']))
		{
			$model->attributes=$_POST['Design'];
			if($model->save())
				$this->redirect(['admin']);
		}

		$this->render('_form',array(
			'model'=>$model,
		));
	}

	public function actionDelete($id)
	{
		$model = System::loadModel('Design', $id);
		$model->delete();

		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Design');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	public function actionAdmin()
	{
		if (isset($_GET['pageSize'])) {
			Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
			unset($_GET['pageSize']);
		}
		$model=new Design('search');
		$model->unsetAttributes();
		if(isset($_GET['Design']))
			$model->attributes=$_GET['Design'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
}
