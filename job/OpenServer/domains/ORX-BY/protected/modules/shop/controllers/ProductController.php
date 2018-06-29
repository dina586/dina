<?php

class ProductController extends Controller
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
				'actions'=>array('index','view', 'share', 'popular', 'new', 'captcha'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update', 'upload', 'SetFrontImage', 'FileDelete', 'seo'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete', 'exel'),
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
		
		$model = System::loadModel('Product', null, $url);
		$this->seo($model->seo_title, $model->seo_keywords, $model->seo_description, $model->name);
		
		Product::model()->updateByPk($model->id, array('recently_viewed'=>date("Y-m-d H:i:s")));
		$comment=$this->newComment($model->id);
		$dataProvider=new CActiveDataProvider('Product',
		array(
			'criteria'=>array(
				"condition"=>"is_view = 1 AND id != ".$model->id,
				'order'=>'recently_viewed DESC',
			),
			'pagination' => array('pageSize' => 5),
			'totalItemCount' => 1, 
		));
		$commentDataProvider = new CActiveDataProvider('Comment',
		array(
			'criteria'=>array(
				"condition"=>"product_id = ".$model->id." AND is_new = 0",
				'order'=>'create_time',
			),
		));
		
		$rating = (int)$this ->getSummRating($model->id);
		
		$this->render('view',array(
			'model'=>$model,
			'dataProvider'=>$dataProvider,
			'comment'=>$comment,
			'commentData'=>$commentDataProvider,
			'rating' => $rating
		));
	}
	/**
	 * Creates a new comment.
	 * This method attempts to create a new comment based on the user input.
	 * If the comment is successfully created, the browser will be redirected
	 * to show the created comment.
	 * @param Post the post that the new comment belongs to
	 * @return Comment the comment instance
	 */
	protected function newComment($postId)
	{
		$comment=new Comment;
		if(isset($_POST['Comment']))
		{
			$comment->attributes=$_POST['Comment'];
			$comment->product_id = $postId;
			$comment->image = CUploadedFile::getInstance($comment, 'image');
			$file = false;
			if($comment->image){
				$file= ROOT_PATH . DIRECTORY_SEPARATOR .'upload'.DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR. $comment->image->name;
				$comment->image->saveAs($file);
			}
			if($comment->save()) {
				$id = $comment->getPrimaryKey();
				if ($file){	
					$resizeObj = new ImageResize($file);
					$resizeObj -> resizeImage(135, 90, 'crop');
		            $resizeObj -> saveImage(
		            ROOT_PATH. DIRECTORY_SEPARATOR .
		            'upload'.DIRECTORY_SEPARATOR.
		            'comment'.DIRECTORY_SEPARATOR.
		            $id.".jpg", 100);
		            unlink($file);
				}
				Yii::app()->user->setFlash('commentSubmitted','Ваш отзыв успешно добавлен!');
				$this->refresh();
			}
		}
		return $comment;
	}
	private function getSummRating($id) {
		$stars = Comment::model()->findAll(array('condition'=>'product_id=:product_id AND is_new = 0', 'params'=>array(':product_id'=>$id)));
		$star = $i = 0;
		if(count($stars)>0) {
			foreach($stars as $value) {
				$star = $star + $value->star;
				$i++;
			}
			$value = $star / $i;
			
		} else {
			$value = 0;
		}
		return $value;
	}
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Product;
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		
		if(isset($_POST['Product']))
		{
			$session=new CHttpSession;
			$session->open();
			
			$model->attributes = $_POST['Product'];
			$model->image = CUploadedFile::getInstance($model,'image');
			$catalogList = array();
			if(isset($_POST['Catalog_list']))
			$catalogList = $_POST['Catalog_list'];
			
			//Забираем изображение из сессии
			if(isset($session['frontImage'])) {
				$model->front_image = $session['frontImage'];
			}
			
			if($model->save()){ 
				$id = $model->getPrimaryKey();
				$this->insertIntoConnect($catalogList, $id);
				/*Забираем название папки из сессии*/
				$tempFolder = $session['uploadDir'];
				
				/*Устанавливаем директорию для копирования*/
				$folder = ROOT_PATH.DIRECTORY_SEPARATOR.'upload'.DIRECTORY_SEPARATOR.'product'.DIRECTORY_SEPARATOR.$id.DIRECTORY_SEPARATOR;
				$cFile = Yii::app()->cFile->set($tempFolder);
				$cFile -> copy($folder, 0777);
				
				/*Удаляем temp директорию*/
				$cFile -> delete();
				
				/*Очищаем сессию*/
				$session->remove('uploadDir');
				$session->remove('dirName');
				$session->remove('front_image');
				$session->close();
				$this->redirect(array('view','url'=>$model->url));
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
		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/fileDelete.jquery.js', CClientScript::POS_HEAD);
		Yii::app()->cFile->createDir(0777, ROOT_PATH.'/upload/product/'.$id.'/original');
		Yii::app()->cFile->createDir(0777, ROOT_PATH.'/upload/product/'.$id.'/thumbnails');
		
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Product']))
		{
			$model->attributes=$_POST['Product'];
			$model->image = CUploadedFile::getInstance($model,'image');
			$catalogList = array();
			if(isset($_POST['Catalog_list']))
			$catalogList = $_POST['Catalog_list'];
			$this->deleteFromConnect($catalogList, $model->id);
			$this->insertIntoConnect($catalogList, $model->id);
						
			if($model->save()) {
				/*Забираем название папки из сессии*/
				$session=new CHttpSession;
				$session->open();
				
				/*Очищаем сессию*/
				$session->remove('uploadDir');
				$session->remove('dirName');
				$session->close();
				$this->redirect(array('view','url'=>$model->url));
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
			Yii::import('application.modules.clients.models.*');
			if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();
			
			Connect::model()->deleteAll('product_id=:product_id', array(':product_id'=>$id));
			
			COrder::model()->deleteAll('product_id=:product_id', array(':product_id'=>$id));
			
			$dir = Yii::getPathOfAlias('webroot').DS.'upload'.DS.'product'.DS.$id.DS;			
			/*Удаляем директорию*/
			$cFile = Yii::app()->cFile->set($dir)-> delete();
			
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
		$dataProvider=new CActiveDataProvider('Product',
		array(
			'criteria'=>array(
			"condition"=>"is_view = 1",
			'order'=>'position, date DESC',
			),
			'pagination'=>array(
				'pageSize'=>10,
			),
		));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
	
	public function actionShare()
	{
		$this->layout= '//layouts/tmp_2columns';
		$this->seo('Акции');
		$dataProvider=new CActiveDataProvider('Product',
		array(
			'criteria'=>array(
			"condition"=>"is_view = 1 AND share_price != ''",
			'order'=>'position, date DESC',
			),
			'pagination'=>array(
				'pageSize'=>12,
			),
		));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
	
	public function actionNew()
	{
		$this->seo('Новинки');
		$this->layout= '//layouts/tmp_2columns';
		$dataProvider=new CActiveDataProvider('Product',
		array(
			'criteria'=>array(
			"condition"=>"is_view = 1 AND new = 1",
			'order'=>'position, date DESC',
			),
			'pagination'=>array(
				'pageSize'=>12,
			),
		));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}
	public function actionSeo()
	{
		if (isset($_GET['pageSize'])) {
			Yii::app()->user->setState('pageSize',(int)$_GET['pageSize']);
			unset($_GET['pageSize']);
		}
		$model=new Product('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Product']))
			$model->attributes=$_GET['Product'];
		
		$this->render('seo',array(
			'model'=>$model,
		));
	}
	
	public function actionPopular()
	{
		$this->layout= '//layouts/tmp_2columns';
		$this->seo('Популярные');
		$dataProvider=new CActiveDataProvider('Product',
		array(
			'criteria'=>array(
			"condition"=>"is_view = 1 AND top_season = 1",
			'order'=>'position, date DESC',
			),
			'pagination'=>array(
				'pageSize'=>12,
			),
		));
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
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
		$model=new Product('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Product']))
			$model->attributes=$_GET['Product'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
	
	public function actionUpload() {
		Yii::import("ext.EAjaxUpload.qqFileUploader");
		
		/*Запускаем сессию и забираем из неё имя папки*/
		$session=new CHttpSession;
		$session->open();
		$temp = $session['uploadDir']; // folder for temp uploaded files
		
	   
	   	 /*Загружаем файлы на сервер*/    
	    $allowedExtensions = array("jpeg", "jpg", "png", "gif");
		$sizeLimit = 10 * 1024 * 1024;// maximum file size in bytes
		$uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
		$result = $uploader->handleUpload($temp);
		
		/*Задаем имя файла*/
		$dateStamp = date("YmdHis");
	    $fileName = $dateStamp.'_'.rand(1,100);
	    
	    /*Начинаем обработку полученных файлов*/
		if($result['success'] == 1 && Yii::app()->cFile->set($temp.$result['filename'])->exists){
			
			/*Получаем расширение файла*/
			$ext = Yii::app()->cFile->set($temp.$result['filename'])->getExtension();
			
			/*Обрабатываем увеличенную копию изображения*/
			$resizeObj = new ImageResize($temp . $result['filename']);
			$resizeObj -> resizeImage(1024, 800, 'auto');
			$resizeObj  -> saveImage($temp . DIRECTORY_SEPARATOR.'original'.DIRECTORY_SEPARATOR.$fileName.'.'.$ext, 120);
			
			/*Обрабатываем уменьшенную копию изображения*/
			$resizeObj = new ImageResize($temp . $result['filename']);
			$resizeObj -> resizeImage(130, 110, 'crop');
			$resizeObj  -> saveImage($temp . DIRECTORY_SEPARATOR.'thumbnails'.DIRECTORY_SEPARATOR.$fileName.'.'.$ext, 100);
			
			/*Записываем первый добавленный файл в сессию, он будет обложкой*/
			if(!isset($session['frontImage'])){
				$session['frontImage'] = $fileName.'.'.$ext;	
			}			
			/*Удаляем старое изображение*/
			unlink($temp.$result['filename']);
		}
		
		$session->close();
		$result = htmlspecialchars(json_encode($result), ENT_NOQUOTES);
		echo $result; //array
	}
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Product::model()->findByPk($id);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='product-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	/**
	 * @param CModel the model to be created
	 */
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
	/**
	 * Вывод изображений для редактирования и удаления
	 */
	public function viewFileToDelete($directory, $productId){
		
		//Получаем содержимое папки
		$cFile = Yii::app()->cFile->set($directory.DIRECTORY_SEPARATOR.'thumbnails');
		$fileArray = $cFile->getContents(true);
		
		//Ссылка на оригинал
		$imgPath = $directory.DIRECTORY_SEPARATOR.'original';
		
		if($fileArray !== false) {
			
			echo '<ul id = "a-images_delete" class = "shop_image_list a-shop_images">';
			foreach($fileArray as $key => $value) {
				$pathArr = explode(DIRECTORY_SEPARATOR, $value);
				$img = end($pathArr);
				
				//Создаем кнопку для редактирования главной картинки
				$updateButton = CHtml::ajaxLink('Установить на обложку', 
					Yii::app()->createUrl('/shop/product/SetFrontImage'),
					array(
						'type'=>'POST',
						'data'=>array(
							'img' => $value,
							'id'  => $productId
				   		),
				   		'success'=>'function(data){
				   			var img = "/upload/product/'.$productId.'/thumbnails/"+data;
	        				$("#d-product_image img").remove();
	        				$("#d-product_image").append("<img src = "+img+" />");
	        			}'	
					)
				);
				
				//Url для удаления картинки
				$url = Yii::app()->createUrl('/shop/product/fileDelete', array('img'=>$value, 'id'=>$productId));
				
				//Выводим изображения
				echo '<li>';
					echo '<a class = "j-lightbox_link" href = "/upload/product/'.$productId.'/original/'.$img.'">';	
						echo '<img src = "/upload/product/'.$productId.'/thumbnails/'.$img.'" alt = "Товар"/>';
					echo '</a>';
					echo $updateButton;
					echo '<br/><br/>';
					echo '<a href = "'.$url.'" class ="a-img_delete">Удалить</a>';
				echo '</li>';
				
			}
			echo '</ul>';
		}
		
	}
	public function viewImages($directory, $id){
		//Получаем содержимое папки
		
		$fileArray = Yii::app()->cFile->getFileNames($directory.DIRECTORY_SEPARATOR.'thumbnails'.DIRECTORY_SEPARATOR);
		
		//Путь к директории с изображениями
		$imgDir = '/upload/product/'.$id;
		if(count($fileArray)>0) {
			echo '<ul class = "j-light_box product_img_container">';
			foreach($fileArray as $key => $img) {
				//Выводим изображения
				echo '<li>';
					echo '<a class = "j-lightbox_link" href = "'.$imgDir.'/original/'.$img.'">';	
						echo '<img src = "'.$imgDir.'/thumbnails/'.$img.'" alt = "Товар"/>';
					echo '</a>';
				echo '</li>';
			}
			echo '</ul>';
		}
	}
	public function actionSetFrontImage(){
		//Получаем путь до картинки
		$imgPath = Yii::app()->request->getParam('img');
		
		//Получаем id товара
		$id = Yii::app()->request->getParam('id');
		
		//Выделяем саму картинку из массива
		$a = explode(DIRECTORY_SEPARATOR, $imgPath);
		$img = end($a);
		
		//Добавляем в базу
		Product::model()->updateByPk($id, array('front_image'=>$img));
		echo $img;
	}
	
	public function actionFileDelete(){
		//Миниарюра
		$imgSmall = Yii::app()->request->getParam('img');
		//Оригинал
		$imgBig = preg_replace('/thumbnails/i', 'original', $imgSmall);
		
		//Удаляем миниатюру
		$cFile = Yii::app()->cFile->set($imgSmall);
		$cFile -> delete();
		
		//Удаляем оригинал
		$cFile = Yii::app()->cFile->set($imgBig);
		$cFile -> delete();
	}
	private function insertIntoConnect($catalogArray, $prodId) {
		$catalogArray = $this->formArrayToCatalog($catalogArray);
		if(count($catalogArray)>0) {
			foreach($catalogArray as $value) {
				$count = Connect::model()->count("catalog_id=:catalog_id AND product_id=:product_id", array(":catalog_id" => $value, ':product_id'=>$prodId));
				if($count != 0){
					continue;
				}
				else {
					$model = new Connect();
					$model->catalog_id = $value;
					$model->product_id = $prodId;
					$model->save();
				}
			}
		}
	}
	private function deleteFromConnect($catalogArray, $prodId) {
		$sql = 'DELETE FROM tbl_sconnect_prod_cat WHERE product_id = '.$prodId.'';
		$data = implode(', ', $this->formArrayToCatalog($catalogArray));
		if($data != '') {
			$sql = $sql.' AND catalog_id NOT IN ('.$data.')';
		} 
		Yii::app()->db->createCommand($sql)->execute();
	}
	
	private function formArrayToCatalog($catalogArray) {
		if(count($catalogArray)>0){
			foreach($catalogArray as $key => $value) {
				$newArray[$key] = $key;
			}
		}
		else {
			return $newArray = array();
		}
		return $newArray;
	}

}
