<?php

/**
 * @author Nicholas Kobets <wemadefoxnever@gmail.com>
 * @copyright 365-solutions.com
 * @license http://365-solutions.com/general-license
 */
class FileHelper {
	
	/**
	 * Загрузка в папку temps 
	 * @return array
	 */
	public static function qqUploadTemp() {
		Yii::import("application.modules.file.components.qqFileUploader");
		Yii::import("application.modules.seo.components.Translit");
		
		$temp = Yii::getPathOfAlias('webroot').DS.'upload'.DS.'temp'.DS;
		
		//Загрузка файла на сервер
		$uploader = new qqFileUploader(Yii::app()->getModule('file')->getAllowedExt(
			Yii::app()->request->getParam('file_type')), 
			Yii::app()->request->getParam('sizeLimit')
		);
		
		$result = $uploader->handleUpload($temp);
		$tempFile = Yii::app()->cFile->set($temp . Yii::app()->request->getParam('qqfile'), true);
		
		//Приводим имя в вебовский вид
		$baseName = strtolower(Translit::transliterate($tempFile->getFilename(), '_', true));
		$tempFile->setFilename($baseName);
		$tempFile->setExtension(strtolower($tempFile->getExtension()));
		
		return ['result'=>$result, 'tempFile'=>$tempFile];
	}
}
