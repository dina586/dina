<?php
class ImageBehavior extends CActiveRecordBehavior {
	
	/*
	 * Массив для передачи параметров
	 * Массив принимает значения папки, ширины, высоты изображения
	 * Ключ - поле
	 * field => array(folder, width, height, type)
	 */
	public $data = array();
	
	public function afterSave($event){
		//Базовый путь к upload директории
		$path = Yii::getPathOfAlias('webroot').DS.'upload'.DS;
		
		foreach($this->data as $field => $imageData) {
			$cFile = Yii::app()->cFile;
			$cFile->createDir($path.$imageData['folder']);
			$cFile->set($path.$imageData['folder'], true)->setPermissions(Yii::app()->params['folderPermission']);
			
			$file = CUploadedFile::getInstance($this->owner, $field);
			if($file) {
				$image = $path.'temp'.DS.$file->name;
				$file->saveAs($image);
				
				$imgObj = new Image($image);
				
				if(DS == '/')
					$path = '/upload/';
				
				$imgObj -> resize($imageData['width'], $imageData['height'], $path.$imageData['folder'].DS, $this->owner->id, 'crop');
				unlink($image);
			}
			
		}
	}
	
	public function afterDelete($event) {
		
		$path = Yii::getPathOfAlias('webroot').DS.'upload'.DS;
		
		foreach($this->data as $field => $imageData) {
			Yii::app()->cFile->set($path.$imageData['folder'].DS.$this->owner->id.'.jpg')->delete();
		}
		
	}
	
}