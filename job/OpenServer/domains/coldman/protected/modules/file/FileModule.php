<?php

/**
 * @author Nicholas Kobets <wemadefoxnever@gmail.com>
 * @copyright 365-solutions.com
 * @license http://365-solutions.com/general-license
 */
class FileModule extends CWebModule {

	public $imgExt = array("jpeg", "jpg", "png", "gif", 'bmp');
	public $fileExt = array('rar', 'zip', '7z', 'mp3', 'mp4');
	public $documentExt = array('txt', 'doc', 'docx', 'pdf', 'xls', 'xlsx', 'pptx', 'ppt');
	
	//Размеры оригинала после resize по умолчанию
	public $original = array('width' => '1280', 'height' => '1024', 'type' => 'auto');
	public $noImage = 'no-img.png';
	public $uploadFolder = 'file_manager';

	public function init() {
		$this->setImport(array(
			'file.models.*',
			'file.components.*',
		));
	}

	public function beforeControllerAction($controller, $action) {
		if (parent::beforeControllerAction($controller, $action)) {
			return true;
		} else
			return false;
	}

	public function generateName($dir, $ext = '', $lettersNumber = 10) {
		$dir = rtrim($dir, DS);
		do {
			$checkName = $name = cText::cropStr(md5(date("YmdHis").rand(1, 1000)), $lettersNumber);
			if ($ext != '')
				$checkName = $name.'.'.$ext;
		}
		while (Yii::app()->cFile->set($dir.DS.$checkName)->exists);

		return $checkName;
	}

	public function generateFileName($dir, $fileName, $ext, $folder = 'admin') {
		$i = 1;
		$fileName = str_replace(array(' ', ',', '.', '#'), '_', $fileName);

		$checkName = str_replace(array('{duplicate}'), $i, $fileName).'.'.$ext;

		while (Yii::app()->cFile->set($dir.$folder.DS.$checkName)->exists) {
			if (strpos($fileName, '{duplicate}')) {
				$checkName = str_replace(array('{duplicate}'), $i, $fileName);
			} else
				$checkName = $fileName.$i;
			$checkName = $checkName.'.'.$ext;
			$i++;
		}

		return $checkName;
	}

	public function getAllowedExt($fileType) {
		switch ($fileType) {
			case 'image' : return $this->imgExt;
			case 'file' : return $this->fileExt;
			case 'document' : return $this->documentExt;
			case 'any' : return array_merge($this->imgExt, $this->fileExt, $this->documentExt);
			default: return $this->imgExt;
		}
	}

}
