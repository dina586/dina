<?php

/**
 * @author Nicholas Kobets <wemadefoxnever@gmail.com>
 * @copyright 365-solutions.com
 * @license http://365-solutions.com/general-license
 */
class UploadController extends Controller {

	//Позиция по умолчанию при сохранении файла в базе данных
	public $itemPosition;

	public function filters() {
		return array(
			'accessControl',
			'postOnly + delete',
		);
	}

	public function accessRules() {
		return array(
			array('allow',
				'actions' => array('base', 'delete', 'cover', 'description', 'position', 'file'),
				'users' => array('*'),
			),
			array('deny',
				'users' => array('*'),
			),
		);
	}

	/**
	 * Загрузка файла на сервер
	 * @param int $id
	 * @param string $name
	 */
	public function actionBase($id, $name) {
		$uploadData = FileHelper::qqUploadTemp();
		$result = $uploadData['result'];
		$tempFile = $uploadData['tempFile'];

		$folderName = $this->getFolder($id, $name);
		$dir = Yii::getPathOfAlias('webroot').DS.'upload'.DS.$this->module->uploadFolder.DS.$folderName.DS;

		if (isset($result['success'])) {

			$cover = $_GET['cover'] == 'true' ? true : false;

			if (in_array(strtolower($tempFile->getExtension()), $this->module->imgExt))
				$modelId = $this->uploadImage($tempFile, $folderName, $dir, $id, $cover);
			else
				$modelId = $this->uploadFile($tempFile, $folderName, $dir, $id);

			$html = $this->renderPartial('file_uploader.views._image', array(
				'data' => FileManager::model()->findByPk($modelId), 
				'cover' => $cover
				), true);

			$tempFile->delete();
		}
		$html = str_replace("\r\n", '', $html);
		$result['imagedata'] = str_replace("\n", '', $html);
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
		if (isset($_POST)) {
			$model = System::loadModel('FileManager', $_POST['id']);
			$model->description = $_POST['value'];
			$model->save();
		}
	}

	/**
	 * Изменяем позицию изображений в базе данных
	 */
	public function actionPosition() {
		if (isset($_POST)) {
			$data = $_POST;
			foreach ($data as $key => $value) {
				FileManager::model()->updateByPk($key, array('position' => $value));
			}
		}
	}

	/**
	 * Установка на обложку изображения
	 * @param int $id
	 */
	public function actionCover($id) {
		$model = System::loadModel('FileManager', $id);
		FileManager::model()->updateAll(
			array('cover' => 0), 
			'model_id=:model_id AND model_name=:model_name', 
			array(':model_id' => $model->model_id, ':model_name' => $model->model_name)
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

		$fileName = strtolower(Yii::app()->getModule('file')->generateName($dir, $tempFile->getExtension()));

		if (isset($_GET['filename_template']) && $_GET['filename_template'] != '')
			$fileName = Yii::app()->getModule('file')->generateFileName($dir, $_GET['filename_template'], $tempFile->getExtension());


		if (DS == '/')
			$dir = '/upload/file_manager/'.$folderName.'/';

		if (isset($_GET['original'])) {
			$imageSize = $_GET['original'];
			$type = key_exists('type', $_GET['original']) ? $_GET['original']['type'] : 'auto';
		} else {
			$imageSize = $this->module->original;
			$type = 'auto';
		}

		//Оригинал
		$imgObj = new Image($tempFile->getRealPath());
		$file = $imgObj->resize($imageSize['width'], $imageSize['height'], $dir.'original'.DS, $fileName, $type);

		//Обложка или изображения среднего размера
		if (isset($_GET['medium'])) {
			$imageSize = $_GET['medium'];
			$type = key_exists('type', $imageSize) ? $imageSize['type'] : 'crop';

			$imgObj = new Image($tempFile->getRealPath());
			$imgObj->resize($imageSize['width'], $imageSize['height'], $dir.'medium'.DS, $fileName, $type);
		}

		//Миниатюра
		$imageSize = $_GET['thumbnail'];
		$type = key_exists('type', $imageSize) ? $imageSize['type'] : 'crop';

		$imgObj = new Image($tempFile->getRealPath());
		$imgObj->resize($imageSize['width'], $imageSize['height'], $dir.'thumbnail'.DS, $fileName, $type);

		//Миниатюра для админки
		$imgObj = new Image($tempFile->getRealPath());
		$imgObj->resize(100, 100, $dir.'admin'.DS, $fileName, 'crop');

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
		
		if (isset($_GET['originalName']) && $_GET['originalName'] == 'true'){
			$fileName = $tempFile->getBasename();
		}
		elseif (isset($_GET['filename_template']) && $_GET['filename_template'] != '')
			$fileName = Yii::app()->getModule('file')->generateFileName($dir, $_GET['filename_template'], $tempFile->getExtension(), 'file');
		

		$tempFile->copy($dir.'file'.DS.$fileName, Yii::app()->params['folderPermission']);
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

		if (Yii::app()->user->getState('file_manager_folder_'.$name))
			$folderName = Yii::app()->user->getState('file_manager_folder_'.$name);
		else
			$folderName = Yii::app()->getModule('file')->generateName(Yii::getPathOfAlias('webroot').DS.'upload'.DS.$this->module->uploadFolder);

		if ($id < 0)
			$criteria->compare('folder', $folderName, true);

		$model = FileManager::model()->find($criteria);

		if ($model !== null) {
			$folderName = $model->folder;
			$this->itemPosition = $model->position + 1;
		} else {
			$this->itemPosition = 1;
		}

		if ($id < 0 && !Yii::app()->user->hasState('file_manager_folder_'.$name))
			Yii::app()->user->setState('file_manager_folder_'.$name, $folderName);

		$dir = Yii::getPathOfAlias('webroot').DS.'upload'.DS.$this->module->uploadFolder.DS.$folderName.DS;
		$cFile = Yii::app()->cFile;

		//Общая папка
		$cFile->createDir($dir);
		$cFile->set($dir, true)->setPermissions(Yii::app()->params['setFolderPermission']);

		//Миниатюры для админки
		$cFile->createDir($dir.'admin');
		$cFile->set($dir.'admin', true)->setPermissions(Yii::app()->params['setFolderPermission']);

		//Оригиналы
		$cFile->createDir($dir.'original');
		$cFile->set($dir.'original', true)->setPermissions(Yii::app()->params['setFolderPermission']);

		//Миниатюры
		$cFile->createDir($dir.'thumbnail');
		$cFile->set($dir.'thumbnail', true)->setPermissions(Yii::app()->params['setFolderPermission']);

		//Файлы
		$cFile->createDir($dir.'file');
		$cFile->set($dir.'file', true)->setPermissions(Yii::app()->params['setFolderPermission']);

		//Обложка или изображения среднего размера
		if (isset($_GET['medium'])) {
			$cFile->createDir($dir.'medium');
			$cFile->set($dir.'medium', true)->setPermissions(Yii::app()->params['setFolderPermission']);
		}

		return $folderName;
	}

	public function actionFile($id) {
		$model = System::loadModel('FileManager', $id);
		Yii::app()->request->sendFile(
			$model->file, // название файла, который получит юзер
			file_get_contents(Yii::getPathOfAlias('webroot').DS.'upload'.DS.$this->module->uploadFolder.DS.$model->folder.DS.'file'.DS.$model->file)
		);
	}

}
