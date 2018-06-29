<?php

class OpinionsController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/tmp_admin';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
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
				'actions'=>array('index','view', 'captcha'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	public function actions(){
        return array(
            'captcha'=>array(
                'class'=>'CaptchaExtendedAction',
            ),
        );
    }

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Opinions;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
		if(isset($_POST['Opinions']))
		{
			$model->attributes=$_POST['Opinions'];
			$model->image = CUploadedFile::getInstance($model, 'image');
			$file = false;
			if($model->image){
				$file= dirname(Yii::app()->request->scriptFile) . DIRECTORY_SEPARATOR .'upload'.DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR. $model->image->name;
				$model->image->saveAs($file);
			}
			if($model->save())
			{
				$id = $model->getPrimaryKey();
				if ($file){
					$resizeObj = new ImageResize($file);
					$resizeObj -> resizeImage(124, 83, 'crop');
            		$resizeObj -> saveImage(ROOT_PATH."/upload/opinions/".$id.".jpg", 100);
            		unlink($file);
				}
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('create',array(
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
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Opinions']))
		{
			$model->attributes=$_POST['Opinions'];
			$model->image = CUploadedFile::getInstance($model, 'image');
			$file = false;
			if($model->image){
				$file= dirname(Yii::app()->request->scriptFile) . DIRECTORY_SEPARATOR .'upload'.DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR. $model->image->name;
				$model->image->saveAs($file);
			}
			if($model->save()) {
				if ($file){
					$resizeObj = new ImageResize($file);
					$resizeObj -> resizeImage(124, 83, 'crop');
            		$resizeObj -> saveImage(ROOT_PATH."/upload/opinions/".$id.".jpg", 100);
            		unlink($file);
				}
				$this->redirect(array('view','id'=>$model->id));
			}
		}

		$this->render('update',array(
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
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();
			if(file_exists(ROOT_PATH."/upload/opinions/".$id.".jpg"))
            unlink(ROOT_PATH."/upload/opinions/".$id.".jpg");
			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
	$model=new Opinions;
		if(isset($_POST['Opinions'])){
			$model->attributes=$_POST['Opinions'];
			$model->image = CUploadedFile::getInstance($model, 'image');
			$file = false;
			if($model->image){
				$file= dirname(Yii::app()->request->scriptFile) . DIRECTORY_SEPARATOR .'upload'.DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR. $model->image->name;
				$model->image->saveAs($file);
		}
			if($model->save()){
				$id = $model->getPrimaryKey();
				if ($file){
					$resizeObj = new ImageResize($file);
					$resizeObj -> resizeImage(124, 83, 'crop');
            		$resizeObj -> saveImage(ROOT_PATH."/upload/opinions/".$id.".jpg", 100);
            		unlink($file);
				}
				Yii::app()->user->setFlash('comment','Ваш комментарий добавлен. Он будет отображаться после проверки администратором');
				$this->refresh();
			} 
				
		}
		
		$dataProvider=new CActiveDataProvider('Opinions',
		array(
			'criteria'=>array(
			'order'=>'date DESC, id DESC',
			'condition'=>'is_new = 0 AND is_view = 1',
                            
                        ),
                'pagination'=>array(
                    'pageSize'=>15,
                  ),
                ));
                
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
			'model'=>$model,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Opinions('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Opinions']))
			$model->attributes=$_GET['Opinions'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Opinions::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='opinions-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

}
