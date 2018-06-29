<?php

class UploadController extends Controller
{
	//Позиция по умолчанию при сохранении файла в базе данных
	public $itemPosition;
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

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('base', 'delete', 'cover', 'description', 'position'),
				'users'=>array('*'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	
	public function actionBase($id, $name)
	{
		Yii::import("application.modules.file.components.qqFileUploader");
		$temp = Yii::getPathOfAlias('webroot').DS.'upload'.DS.'temp'.DS;
		$folderName = $this->getFolder($id, $name);
		$dir = Yii::getPathOfAlias('webroot').DS.'upload'.DS.$this->module->uploadFolder.DS.$folderName.DS;
		//Загрузка файла на сервер
		$uploader = new qqFileUploader(Yii::app()->getModule('file')->getAllowedExt(Yii::app()->request->getParam('file_type')), $_GET['sizeLimit']);
		$result = $uploader->handleUpload($temp);
		$tempFile = Yii::app()->cFile->set($temp.Yii::app()->request->getParam('qqfile'), true);
		if(isset($result['success'])) {
			
			$cover = $_GET['cover']=='true'?true:false;
			
			if(in_array(strtolower($tempFile->getExtension()), $this->module->imgExt))
				$modelId = $this->uploadImage($tempFile, $folderName, $dir, $id, $cover);
			else 
				$modelId= $this->uploadFile($tempFile, $folderName, $dir, $id);
			
			$html =  $this->renderPartial('file_uploader.views._image', array('data'=>FileManager::model()->findByPk($modelId), 'cover'=>$cover), true);
			
			$tempFile->delete();
		}
		$html = str_replace("\r\n",'',$html);
		$result['imagedata'] = str_replace("\n",'',$html);
		$result = json_encode($result);
		echo $result;
	}
	
	/**
	 * Удаление файла
	 * @param int $id
	 */
	public function actionDelete($id) {
		$model = System::loadModel('FileManager', $id);
		$dir = Yii::getPathOfAlias('webroot').DS.'upload'.DS.$this->module->uploadFolder.DS.$model->folder.DS;

		Yii::app()->cFile->set($dir.'original'.DS.$model->file)->delete();
		Yii::app()->cFile->set($dir.'thumbnail'.DS.$model->file)->delete();
		Yii::app()->cFile->set($dir.'medium'.DS.$model->file)->delete();
		Yii::app()->cFile->set($dir.'admin'.DS.$model->file)->delete();
		Yii::app()->cFile->set($dir.'file'.DS.$model->file)->delete();
		$model->delete();
	}
	
	/**
	 * Сохранение описания для файла
	 */
	public function actionDescription() {
		if(isset($_POST)) {
			$model = System::loadModel('FileManager', $_POST['id']);
			$model->description = $_POST['value'];
			$model->save();
		}
	}
	
	/**
	 * Изменяем позицию изображений в базе данных
	 */
	public function actionPosition() {
		if(isset($_POST)) {
			$data = $_POST;
			foreach($data as $key => $value) {
				FileManager::model()->updateByPk($key, array('position'=>$value));
			}
		}
	}
	
	/**
	 * Установка на обложку изображения
	 * @param int $id
	 */
	public function actionCover($id){
		$model = System::loadModel('FileManager', $id);
		FileManager::model()->updateAll(
			array('cover'=>0), 
			'model_id=:model_id AND model_name=:model_name',
			array(':model_id'=>$model->model_id, ':model_name'=>$model->model_name)
		);
		$model->cover = 1;
		$model->save();
		echo '<span class = "j-file_manager_cover">'.Yii::t('admin', 'Cover').'</span>';
	} 
	
	/**
	 * Загрузка изображения на сервер
	 * @param obj $tempFile
	 * @param string $folderName
	 * @param string $dir
	 * @param int $id
	 * @param bool $cover
	 * @return int modelId 
	 */
	protected function uploadImage($tempFile, $folderName, $dir, $id, $cover) {
		
		$fileName = Yii::app()->getModule('file')->generateName($dir, strtolower($tempFile->getExtension())).'.'.strtolower($tempFile->getExtension());
		
		if(isset($_GET['original']))
			$imageSize = $_GET['original'];
		else
			$imageSize = $this->module->original;
		
		if(DS == '/')
			$dir = '/upload/file_manager/'.$folderName.'/';
		
		//Оригинал
		$imgObj = new Image($tempFile->getRealPath());
		$file = $imgObj -> resize($imageSize['width'], $imageSize['height'], $dir.'original'.DS, $fileName, 'auto');
		
		//Обложка или изображения среднего размера
		if(isset($_GET['medium'])) {
			$imageSize = $_GET['medium'];
			$type = key_exists('type', $imageSize)?$imageSize['type']:'crop';
			$imgObj -> resize($imageSize['width'], $imageSize['height'], $dir.'medium'.DS, $fileName, $type);
		}
		
		//Миниатюра
		$imageSize = $_GET['thumbnail'];
		$type = key_exists('type', $imageSize)?$imageSize['type']:'crop';
		$imgObj -> resize($imageSize['width'], $imageSize['height'], $dir.'thumbnail'.DS, $fileName, $type);
		
		//Миниатюра для админки
		$imgObj -> resize(100, 100, $dir.'admin'.DS, $fileName, 'crop');
		
		return FileManager::saveModel($file, $folderName, $id, $_GET['name'], $cover);
	}
	
	/**
	 * Загрузка файлов на сервер
	 * @param obj $tempFile
	 * @param string $folderName
	 * @param string $dir
	 * @param int $id
	 * @return int modelId 
	 */
	protected function uploadFile($tempFile, $folderName, $dir, $id) {
		$fileName = Yii::app()->getModule('file')->generateName($dir, strtolower($tempFile->getExtension())).'.'.strtolower($tempFile->getExtension());
		
		if(DS == '/')
			$dir = '/upload/file_manager/'.$folderName.'/';
		
		$tempFile -> copy($dir.'file'.DS.$fileName, Yii::app()->params['folderPermission']);
		return FileManager::saveModel($fileName, $folderName, $id, $_GET['name'], false, 'file');
	}
	
	/**
	 * Генерация папок
	 * @param int $id модели для загрузки
	 * @param name $name название модели для загрузки
	 * @return string
	 */
	protected function getFolder($id, $name) {
		$criteria = FileManager::getSearchCriteria($id, $name);
		
		if(Yii::app()->user->getState('file_manager_folder_'.$name))
			$folderName = Yii::app()->user->getState('file_manager_folder_'.$name);
		else
			$folderName = Yii::app()->getModule('file')->generateName(Yii::getPathOfAlias('webroot').DS.'upload'.DS.$this->module->uploadFolder);
		
		if($id < 0)
			$criteria->compare('folder', $folderName, true);
		
		$model = FileManager::model()->find($criteria);
		
		if($model !== null) {
			$folderName = $model->folder;
			$this->itemPosition = $model->position + 1;
		}
		else {
			$this->itemPosition = 1;
		}
		
		if($id <0 && !Yii::app()->user->hasState('file_manager_folder_'.$name))
			Yii::app()->user->setState('file_manager_folder_'.$name, $folderName);
				
		$dir = Yii::getPathOfAlias('webroot').DS.'upload'.DS.$this->module->uploadFolder.DS.$folderName.DS;
		$cFile = Yii::app()->cFile;
		
		//Общая папка
		$cFile->createDir($dir);
		$cFile->set($dir, true)->setPermissions(Yii::app()->params['folderPermission']);	
		
		//Миниатюры для админки
		$cFile->createDir($dir.'admin');
		$cFile->set($dir.'admin', true)->setPermissions(Yii::app()->params['folderPermission']);
		
		//Оригиналы
		$cFile->createDir($dir.'original');
		$cFile->set($dir.'original', true)->setPermissions(Yii::app()->params['folderPermission']);
		
		//Миниатюры
		$cFile->createDir($dir.'thumbnail');
		$cFile->set($dir.'thumbnail', true)->setPermissions(Yii::app()->params['folderPermission']);
		
		//Файлы
		$cFile->createDir($dir.'file');
		$cFile->set($dir.'file', true)->setPermissions(Yii::app()->params['folderPermission']);
			
		//Обложка или изображения среднего размера
		if(isset($_GET['medium'])) {
			$cFile->createDir($dir.'medium');
			$cFile->set($dir.'medium', true)->setPermissions(Yii::app()->params['folderPermission']);
		}
		
		return $folderName;
	}

}
