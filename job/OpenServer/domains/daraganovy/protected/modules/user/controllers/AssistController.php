<?php

/**
 * @author Nicholas Kobets <wemadefoxnever@gmail.com>
 * @copyright 365-solutions.com
 * @license http://365-solutions.com/general-license
 */

/**
 * Вспомогательный контроллер для модуля user.
 * Содержит экшены для загрузки/удаления аватараов и тд
 */
class AssistController extends Controller {

	public $layout = '//layouts/templates/admin';

	public function filters() {
		return array(
			'accessControl',
			'postOnly + delete',
		);
	}

	public function accessRules() {
		return [
			[
				'allow',
				'actions' => array('avatar'),
				'users' => array('@'),
			],
			[
				'deny',
				'users' => array('*'),
			],
		];
	}

	/**
	 * Загрузка аватара на сервер и вывод пользователю
	 */
	public function actionAvatar() {
		Yii::import("application.modules.file.components.qqFileUploader");
		$temp = Yii::getPathOfAlias('webroot').DS.'upload'.DS.'temp'.DS;

		//Загрузка файла на сервер
		$uploader = new qqFileUploader(Yii::app()->getModule('file')->getAllowedExt(Yii::app()->request->getParam('file_type')), $_GET['sizeLimit']);
		$result = $uploader->handleUpload($temp);
		$tempFile = Yii::app()->cFile->set($temp.Yii::app()->request->getParam('qqfile'), true);

		if (isset($result['success'])) {
			if (DS == '/')
				$dir = '/upload/temp/';
			else
				$dir = $tempFile->getDirname();

			$fileName = strtolower(Yii::app()->getModule('file')->generateName($dir, $tempFile->getExtension()));

			$imgObj = new Image($tempFile->getRealPath());
			if ($imgObj->getWidth() < 400 || $imgObj->getheight() < 400) {
				$result['success'] = false;
				$result['message'] = Yii::t('admin', 'Min image width must be 400 pixels and height must be 400 pixels');
			} else {
				$imgObj->resize(1024, 768, $dir, $fileName, 'auto');

				$result['image_name'] = $fileName;
				$result['imagepath'] = '/upload/temp/'.$fileName;
			}
			$tempFile->delete();
		}

		$result = json_encode($result);
		echo $result;
	}

}
