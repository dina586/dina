<?php

class AdminController extends Controller
{
	public $defaultAction = 'admin';
	public $layout='//layouts/templates/admin';
	private $_model;

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
	
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('admin','delete','create','update','view', 'changerole', 'list', 'quick'),
				'roles'=>Yii::app()->authManager->adminRoles(),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	
	public function titles(){
		switch(Yii::app()->controller->action->id){
			case 'admin':
				return Yii::t('admin', 'Clients');
				break;
			case 'list':
				return Yii::t('admin', 'Clients');
				break;
					
			case 'create':
				return Yii::t('admin', 'Add new client');
				break;
					
			case 'update':
				return Yii::t('admin', 'Edit client information');
				break;
			case 'quick':
				return Yii::t('admin', 'Quick client registration');
				break;
		}
	}
	
	protected function beforeAction($event)
	{
		$this->seo($this->titles());
		return true;
	}
	
	public function actionList()
	{
		$model=new User('listSearch');
		$model->unsetAttributes();  // clear any default values
		
		if(!Yii::app()->request->isAjaxRequest)
			Yii::app()->getModule('user')->registerJS();
		
		if(isset($_GET['User'])) {
			$model->attributes = $_GET['User'];
			//$model->s_phone = $_GET['User']['s_phone'];
		}
	
		$this->render('list',array(
			'model'=>$model,
		));
	
	}
	
	public function actionQuick() {
		$model = new QuickRegistration();
		if(isset($_POST['QuickRegistration']))
		{
			$model->attributes = $_POST['QuickRegistration'];
			if($model->validate())	{
				$userId = User::model()->saveUser($model->attributes);
				$this->redirect(array('/calendar/view/index'));
			}
		}
		
		$this->render('application.modules.user.widgets.views.registration', array('model'=>$model));
	}
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{

		$model=new User('search');
        $model->unsetAttributes();  // clear any default values
        if(isset($_GET['User']))
            $model->attributes = $_GET['User'];
		
		$dataProvider=new CActiveDataProvider('User', array(
			'criteria'=>User::model()->search($model),
			'sort'=>array(
				'defaultOrder'=>'create_at DESC',
				'attributes'=>array(
					'user_role'=>array(
						'asc'=>'roles.role',
						'desc'=>'roles.role DESC',
					),
					'*',
					
				),
			),
        	'pagination'=>array(
				'pageSize'=> 12,
			),
		));
		
        $this->render('index',array(
            'dataProvider'=>$dataProvider,
        	'model'=>$model,
        ));

	}


	/**
	 * Displays a particular model.
	 */
	public function actionView($id)
	{
		Yii::import('application.modules.service.models.*');
		$model = System::loadModel('User', $id);
		$this->seo(Yii::t('admin', 'View client').' '.$model->profile->firstname.' '.$model->profile->lastname);
		
		if (isset($_GET['pageSize'])) {
			Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
			unset($_GET['pageSize']);
		}
		
		$service= new UserService('search');
		$service->unsetAttributes();  // clear any default values
		
		if(isset($_GET['UserService']))
			$service->attributes=$_GET['UserService'];
		
		$service->user_id = $model->id;
		
		$this->render('view',array(
			'model'=>$model,
			'service'=>$service,
			'profile'=>$model->profile,
		));
	}
	
	public function actionChangerole() {
		$id = Yii::app()->request->getParam('id');
		$role = Yii::app()->request->getParam('role');
		if(Yii::app()->request->isAjaxRequest) {
			Roles::model()->updateByPk($id, array('role'=>$role));
		} else {
			$this->redirect(Yii::app()->createUrl('site/index'));
		}
	}
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new User;
		$profile=new Profile;
		$this->performAjaxValidation(array($model,$profile));
		Yii::app()->getModule('user')->registerJS();

		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			$model->activkey=Yii::app()->controller->module->encrypting(microtime().$model->password);
			$profile->attributes=$_POST['Profile'];
			$profile->user_id=0;
			if($model->validate()&&$profile->validate()) {
				$model->password=Yii::app()->controller->module->encrypting($model->password);
				if($model->save()) {
					$profile->user_id=$model->id;
					$profile->save();
				}
				$this->redirect(array('view','id'=>$model->id));
			} else $profile->validate();
		}

		$this->render('_form',array(
			'model'=>$model,
			'profile'=>$profile,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionUpdate()
	{
		$model=$this->loadModel();
		$profile=$model->profile;
		$this->performAjaxValidation(array($model,$profile));
		Yii::app()->getModule('user')->registerJS();
		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			$profile->attributes=$_POST['Profile'];
			
			if($model->validate()&&$profile->validate()) {
				$old_password = User::model()->notsafe()->findByPk($model->id);
				if ($old_password->password!=$model->password) {
					$model->password=Yii::app()->controller->module->encrypting($model->password);
					$model->activkey=Yii::app()->controller->module->encrypting(microtime().$model->password);
				}
				$model->save();
				$profile->save();
				//Helper::stepRedirect(Yii::app()->createUrl('user/procedure/create', array('user_id'=>$model->id)));
				//$this->redirect(array('view', 'id'=>$model->id));
				$this->stepRedirect($model);
				
			} else $profile->validate();
		}

		$this->render('_form',array(
			'model'=>$model,
			'profile'=>$profile,
		));
	}


	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 */
	public function actionDelete()
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$model = $this->loadModel();
			$profile = Profile::model()->findByPk($model->id);
			$roles = Roles::model()->findByPk($model->id);
			$transaction = Yii::app()->db->beginTransaction();
			try {
			    // поиск и сохранение — шаги, между которыми могут быть выполнены другие запросы,
			    // поэтому мы используем транзакцию, чтобы удостовериться в целостности данных
				$profile->delete();
				$model->delete();
				$roles->delete();
			    $transaction->commit();
			}
			catch(Exception $e) {
			    $transaction->rollback();
			}
			
			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_POST['ajax']))
				$this->redirect(array('/user/admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}
	
	/**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($validate)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
        {
            echo CActiveForm::validate($validate);
            Yii::app()->end();
        }
    }
	
	
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 */
	public function loadModel()
	{
		if($this->_model===null)
		{
			if(isset($_GET['id']))
				$this->_model=User::model()->notsafe()->findbyPk($_GET['id']);
			if($this->_model===null)
				throw new CHttpException(404,'The requested page does not exist.');
		}
		return $this->_model;
	}
	
	protected function stepRedirect($model){
		if(isset($_POST['yt0']))
			$this->redirect(array('view', 'id'=>$model->id));
		else
			$this->redirect(array('/user/procedure/create', 'user_id'=>$model->id));
	}
	
}