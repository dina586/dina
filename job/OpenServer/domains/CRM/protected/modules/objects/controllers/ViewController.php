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
				return Yii::t('admin', 'Добавить объект');
				break;
					
			case 'update':
				return Yii::t('admin', 'Редактирование данных об объекте');
				break;
					
			case 'admin':
				return Yii::t('admin', 'Наши работы');
				break;
		}
	}
	
	protected function beforeAction($event)
	{
		$this->seo(Helper::seoPage($this->titles(), 'Objects_page'), '', Helper::seoPage($this->titles(), 'Objects_page'));
		return true;
	}
	
	public function actionView($id)
	{
		$this->layout='//layouts/templates/base';
		$model = System::loadModel('Objects', $id);
		
		$this->seo($model->name);
		
		$this->render('view',array(
			'model'=>$model,
		));
	}

	public function actionCreate()
	{
		$model=new Objects;

		if(isset($_POST['Objects']))
		{
			$model->attributes=$_POST['Objects'];
			if($model->save())
				$this->redirect(['view','id'=>$model->id]);
		}

		$this->render('_form',array(
			'model'=>$model,
		));
	}

	public function actionUpdate($id)
	{
		$model = System::loadModel('Objects', $id);

		if(isset($_POST['Objects']))
		{
			$model->attributes=$_POST['Objects'];
			if($model->save())
				$this->redirect(['view','id'=>$model->id]);
		}

		$this->render('_form',array(
			'model'=>$model,
		));
	}

	public function actionDelete($id)
	{
		$model = System::loadModel('Objects', $id);
		$model->delete();

		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Objects');
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
		$model=new Objects('search');
		$model->unsetAttributes();
		if(isset($_GET['Objects']))
			$model->attributes=$_GET['Objects'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
}
