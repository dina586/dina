<?php

class DefaultController extends Controller
{
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
				'actions'=>array('create','update', 'upload', 'filedelete'),
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
	
	public function actionIndex()
	{
		$this->layout= '//layouts/tmp_2columns';
		$this->render('index');
	}
	public function actionCreate()
	{
		Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/fileDelete.jquery.js', CClientScript::POS_HEAD);
		$this->layout= '//layouts/tmp_2columns';
		$this->render('create');
	}
	public function actionUpload() {
			Yii::import("ext.EAjaxUpload.qqFileUploader");
	        $id = Yii::app()->request->getParam('id');
	     	$temp = ROOT_PATH.'/upload/temp/';// folder for uploaded files
	        $dateStamp = date("YmdHis");
	        
            $allowedExtensions = array("jpeg", "jpg", "png", "gif");
            $sizeLimit = 10 * 1024 * 1024;// maximum file size in bytes
            $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
            $result = $uploader->handleUpload($temp);
			
            $folder = ROOT_PATH.'/upload/gallery/original/';// folder for uploaded files
			if($result['success'] == 1 && file_exists($temp.$result['filename'])){
	            $resizeObj = new ImageResize($temp . $result['filename']);
				$resizeObj -> resizeImage(800, 600, 'auto');
				$resizeObj  -> saveImage($folder . $dateStamp.$result['filename'], 100);
	            $resizeObj -> resizeImage(200, 150, 'crop');
	            $path = preg_replace('/original\//i', 'thumbnails/', $folder);
		        $resizeObj  -> saveImage($path. $dateStamp.$result['filename'], 90);
	            unlink($temp.$result['filename']);
			}
	        $result = htmlspecialchars(json_encode($result), ENT_NOQUOTES);
			
           	
            echo $result;// it's array
	}
	public function actionFileDelete(){
		echo $name = Yii::app()->request->getParam('name');
		$controller = 'gallery';
		if(file_exists(ROOT_PATH."/upload/".$controller."/thumbnails/".$name)) {
            unlink(ROOT_PATH."/upload/".$controller."/thumbnails/".$name);
		}
		if(file_exists(ROOT_PATH."/upload/".$controller."/original/".$name))
            unlink(ROOT_PATH."/upload/".$controller."/original/".$name);
        
	}
	public function viewFileToDelete($directory){
	
		//Получаем содержимое папки
		$cFile = Yii::app()->cFile->set($directory.'thumbnails'.DIRECTORY_SEPARATOR);
		$fileArray = $cFile->getContents(true);
		if($fileArray !== false) {
			echo '<ul id = "a-images_delete" class = "gallery_image_list a-shop_images">';
			foreach($fileArray as $key => $value) {
				$pathArr = explode(DIRECTORY_SEPARATOR, $value);
				$img = end($pathArr);
			
				//Url для удаления картинки
				$url = Yii::app()->createUrl('/'.$this->module->id.'/'.Yii::app()->controller->id.'/fileDelete', array('name'=>$img));
				//Выводим изображения
				echo '<li>';
					echo '<a class = "j-lightbox_link" href = "/upload/gallery/original/'.$img.'">';	
						echo '<img src = "/upload/gallery/thumbnails/'.$img.'" alt = "Товар"/>';
					echo '</a>';
					echo '<a href = "'.$url.'" class ="a-img_delete">Удалить</a>';
				echo '</li>';
				
			}
			echo '</ul>';
		}
	}
	public function viewGallery($directory){
		//Получаем содержимое папки
		$fileArray = Yii::app()->cFile->getFileNames($directory.'thumbnails'.DIRECTORY_SEPARATOR);
		
		$imgDir = '/upload/gallery/';
		
		if(count($fileArray) > 0) {
			echo '<ul class = "j-light_box gallery_images">';
			foreach($fileArray as $key => $img) {
				//Выводим изображения
				echo '<li>';
					echo '<a class = "j-lightbox_link" href = "'.$imgDir.'original/'.$img.'">';	
						echo '<img src = "'.$imgDir.'thumbnails/'.$img.'" alt = "Товар"/>';
					echo '</a>';
				echo '</li>';
			}
			echo '</ul>';
		}
	}
}
