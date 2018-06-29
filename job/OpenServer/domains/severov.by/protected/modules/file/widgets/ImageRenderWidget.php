<?php
class ImageRenderWidget extends CWidget {
	public $id;
	public $modelName;
	public $cover = false;
	public $type = 'thumbnail';
	
	public function run() {
		if(!Yii::app()->request->isAjaxRequest)
			Yii::app()->clientScript->registerPackage('photobox');
		Yii::import('application.modules.file.models.FileManager');
		
		if($this->cover == false)
			$condition = 'cover = 0';
		else
			$condition = 'cover = 1';
		
		$dataprovider = FileManager::model()->findAll(array(
			'order'=>'position, date DESC',
			'condition'=>'model_id=:model_id AND model_name=:model_name AND file_type=:file_type AND '.$condition,
			'params'=>array(':model_id'=>$this->id, ':model_name'=>$this->modelName, ':file_type'=>'image')
		));
	
		$this->render('view', array('dataprovider'=>$dataprovider));
	}
}