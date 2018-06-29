<?php
class GalleryWidget extends CWidget {
	public $id;
	public $modelName;
	public $cover = true;
	public $type = 'thumbnail';
	public $description = true;
	
	public function run() {
		if(!Yii::app()->request->isAjaxRequest) {
			Yii::app()->clientScript->registerPackage('photobox');
			Yii::app()->clientScript->registerPackage('swipebox');
			Yii::app()->clientScript->registerPackage('lazy');
		}
		Yii::import('application.modules.file.models.FileManager');
		
		if($this->cover == true)
			$condition = '';
		else
			$condition = 'AND cover = 0';
		
		$dataprovider = FileManager::model()->findAll(array(
			'order'=>'position, date DESC',
			'condition'=>'model_id=:model_id AND model_name=:model_name AND file_type=:file_type '.$condition,
			'params'=>array(':model_id'=>$this->id, ':model_name'=>$this->modelName, ':file_type'=>'image')
		));
	
		$this->render('gallery', array('dataprovider'=>$dataprovider));
	}
}