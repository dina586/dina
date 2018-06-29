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
				return Yii::t('admin', 'Добавить изображение в слайдер');
				break;
					
			case 'update':
				return Yii::t('admin', 'Редактирование изображения');
				break;
					
			case 'admin':
				return Yii::t('admin', 'Изображения в слайдере');
				break;
		}
	}
	
	protected function beforeAction($event)
	{
		$this->seo(Helper::seoPage($this->titles(), 'Slider_page'), '', Helper::seoPage($this->titles(), 'Slider_page'));
		return true;
	}

	public function actionCreate()
	{
		$model=new Slider;

		if(isset($_POST['Slider']))
		{
			$model->attributes=$_POST['Slider'];
			if($model->save())
				$this->redirect(['admin']);
		}

		$this->render('_form',array(
			'model'=>$model,
		));
	}

	public function actionUpdate($id)
	{
		$model = System::loadModel('Slider', $id);

		if(isset($_POST['Slider']))
		{
			$model->attributes=$_POST['Slider'];
			if($model->save())
				$this->redirect(['admin']);
		}

		$this->render('_form',array(
			'model'=>$model,
		));
	}

	public function actionDelete($id)
	{
		$model = System::loadModel('Slider', $id);
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
		$model=new Slider('search');
		$model->unsetAttributes();
		if(isset($_GET['Slider']))
			$model->attributes=$_GET['Slider'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
}
