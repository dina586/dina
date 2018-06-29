<?php

class PartnerController extends Controller
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
				'actions'=>array('index','view'),
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
	public function actionView($url)
	{
		$this->layout= '//layouts/tmp_2columns';
		
		$dataProvider=Partner::model()->findAll(array('condition'=>'is_view=1'));
		
		
		
		$this->render('admin',array(
			'dataProvider'=>$dataProvider,
		));
	}
	
	public function actionCreate()
	{
		$model=new Partner;
		
		if(isset($_POST['Partner']))
		{
			$model->attributes=$_POST['Partner'];
			$model->image = CUploadedFile::getInstance($model, 'image');
			$file= ROOT_PATH . DIRECTORY_SEPARATOR .'upload'.DIRECTORY_SEPARATOR.'partner'.DIRECTORY_SEPARATOR. $model->image->name;
			$model->image->saveAs($file);
			if($model->save()) {
				$id = $model->getPrimaryKey();	
				if ($file) {          
					$path= new ImageResize($file);
					$path -> resizeImage(1024, 800, 'auto');
					 $path -> saveImage(
						ROOT_PATH. DIRECTORY_SEPARATOR .
						'upload'.DIRECTORY_SEPARATOR.
						'partner'.DIRECTORY_SEPARATOR.
						$id.".jpg", 100);
						unlink($file);							
					
					$this->redirect(array('admin'));
				}
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

		if(isset($_POST['Partner']))
		{
			$model->attributes=$_POST['Partner'];
			$model->image = CUploadedFile::getInstance($model, 'image');
			$file = false;
			if($model->image){
				$file= ROOT_PATH . DIRECTORY_SEPARATOR .'upload'.DIRECTORY_SEPARATOR.'partner'.DIRECTORY_SEPARATOR. $model->image->name;
				$model->image->saveAs($file);
                                
			}
			if($model->save()) {
				//$id = $model->getPrimaryKey();	
				if ($file) {          
					$path= new ImageResize($file);
					$path -> resizeImage(1024, 800, 'auto');
					 $path -> saveImage(
						ROOT_PATH. DIRECTORY_SEPARATOR .
						'upload'.DIRECTORY_SEPARATOR.
						'partner'.DIRECTORY_SEPARATOR.
						$id.".jpg", 100);
						unlink($file);					
					
				}
				$this->redirect(array('admin'));
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
			$file = Yii::getPathOfAlias('webroot').DS.'upload'.DS.'partner'.DS.$id.'.jpg';			
			/*Удаляем директорию*/
			$cFile = Yii::app()->cFile->set($file)-> delete();
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
		$this->layout= '//layouts/tmp_2columns';
		$dataProvider=Partner::model()->findAll(array('condition'=>'is_view=1'));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}


	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Partner('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Partner']))
			$model->attributes=$_GET['Partner'];

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
		$model=Partner::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	public function checkDir($session){
		/*Если пользователь обновлял станицы, мы ме генерируем новую папку, а берем уже созданную из сессии*/
		if(!isset($session['dirName'])) {
			$timestamp = date("YmdHis");
			$randomNumber = mt_rand(1, 100);
			$dirName = $randomNumber.'_'.$timestamp;
			$session['dirName'] = $dirName; 
		}
		else {
			$dirName = $session['dirName'];
		}
		Yii::app()->cFile->createDir(0777, ROOT_PATH.'/upload/temp/'.$dirName.'/original');
		Yii::app()->cFile->createDir(0777, ROOT_PATH.'/upload/temp/'.$dirName.'/thumbnails');
		return $dirName;
	}

	
	

}
