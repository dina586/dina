<?php

class ViewController extends Controller {

	public $layout = '//layouts/templates/admin';

	public function filters() {
		return array(
			'accessControl',
			'postOnly + delete',
		);
	}
	
	public function accessRules() {
		return array(
			array('allow',
				'actions' => array('index', 'view','tags'),
				'users' => array('*'),
			),
			array('allow',
				'actions' => array('create', 'update', 'admin', 'delete', 'seo', 'beauty', 'suggestTags', 'adminTags','deleteTag'),
				'roles' => array('admin'),
			),
			array('deny',
				'users' => array('*'),
			),
		);
	}

	public function titles() {
		switch (Yii::app()->controller->action->id) {
			case 'create':
				return Yii::t('admin', 'Добавить в портфолио');
				break;

			case 'update':
				return Yii::t('admin', 'Редактировать портфолио');
				break;

			case 'admin':
				return Yii::t('admin', 'порфолио');
				break;

			case 'seo':
				return Yii::t('admin', 'Manage SEO');
				break;

			case 'index':
				return Yii::t('admin', 'портфолио');
				break;
			
			case 'beauty':
				return Yii::t('admin', 'Избранные фото');
				break;
		}
	}

	public function beforeAction($event) {
		$this->seo(Helper::seoPage($this->titles(), 'Portfolio_page'), '', Helper::seoPage($this->titles(), 'Portfolio_page'));
		return true;
	}

	public function actionView($id) {
		$this->layout = '//layouts/templates/base';
		$model = System::loadModel('Portfolio', $id);
		
		$this->render('view', array(
			'model' => $model,
		));
	}

	public function actionCreate() {
		$model = new Portfolio;

		if (isset($_POST['Portfolio'])) {
			$model->attributes = $_POST['Portfolio'];

			if ($model->save())
				$this->redirect(array(Helper::seoLink($model->id, get_class($model))));
		}

		$this->render('_form', array(
			'model' => $model,
		)); 
	}

	public function actionUpdate($id) {
		$model = System::loadModel('Portfolio', $id);

		if (isset($_POST['Portfolio'])) {
			$model->attributes = $_POST['Portfolio'];
			if ($model->save()) 
				$this->redirect(array(Helper::seoLink($model->id, get_class($model))));
		}

		$this->render('_form', array(
			'model' => $model,
		));
	}
	
	public function actionBeauty($id) {
		$model = System::loadModel('Portfolio', $id);

		if (isset($_POST['Portfolio'])) {
			$model->attributes = $_POST['Portfolio'];
			if ($model->save()) 
				$this->redirect(array(Helper::seoLink($model->id, get_class($model))));
		}

		$this->render('beauty', array(
			'model' => $model,
		));
	}

	public function actionDelete($id) {
		$model = System::loadModel('Portfolio', $id);
		$model->delete();

		if (!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	public function actionIndex($type) {
		$this->layout = '//layouts/templates/base';

		if($type == 'photo')
			$radio = 0;
		else
			$radio = 1;
		
		$dataProvider = new CActiveDataProvider('Portfolio', array(
			'criteria' => array(
				"condition" => "is_view=1 and radiobutton = ".$radio,
				'order' => 'create_date DESC, id DESC',
			),
			'pagination' => array(
				'pageSize' => 10,
			),
		));

		$this->render('index', array(
			'dataProvider' => $dataProvider,
			'type'=>$radio,
		));
	}

	public function actionTags($tag, $type) {
		if($type == 'photo')
			$radio = 0;
		else
			$radio = 1;
		$this->layout = '//layouts/templates/base';

		$dataProvider = new CActiveDataProvider('Portfolio', array(
			'pagination' => array(
				'pageSize' => 10,
			),
			'criteria' => array(
				//"condition" => "is_view=1 and tags like '%".$tag."%'",
				"condition" => "is_view=1 AND radiobutton=:radiobutton AND tags LIKE '%".CHtml::encode($tag)."%'",
				'params'=>[':radiobutton'=>$radio],
				'order' => 'id DESC',
			),
		));

		$this->render('index', array(
			'dataProvider' => $dataProvider,
			'type'=>$radio,
		));
	}

	public function actionAdmin() {
		if (isset($_GET['pageSize'])) {
			Yii::app()->user->setState('pageSize', (int) $_GET['pageSize']);
			unset($_GET['pageSize']);
		}
		$model = new Portfolio('search');
		$model->unsetAttributes();
		if (isset($_GET['Portfolio']))
			$model->attributes = $_GET['Portfolio'];

		$this->render('admin', array(
			'model' => $model,
		));
	}

	public function actionSuggestTags()
	{
		if(isset($_GET['q']) && ($keyword=trim($_GET['q']))!=='')
		{
			$tags=Tag::model()->suggestTags($keyword);
			if($tags!==array())
				echo implode("\n",$tags);
		}
	}
	
	 public function actionAdminTags() {
		if (isset($_GET['pageSize'])) {
			Yii::app()->user->setState('pageSize', (int) $_GET['pageSize']);
			unset($_GET['pageSize']);
		}
		$model = new Tag('search');
		$model->unsetAttributes();
		if (isset($_GET['Tag']))
			$model->attributes = $_GET['Tag'];

		$this->render('admintag', array(
			'model' => $model,
		));
	}
        
    public function actionDeleteTag($id) {
		$model = System::loadModel('Tag',id);
		$model->delete();

		if (!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}
}
