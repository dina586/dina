<?php
class BeautyGalleryWidget extends CWidget {
	public $id;
	public $type = 'thumbnail';
	
	public function run() {
		Yii::app()->clientScript->registerPackage('galleria');
		Yii::import('application.modules.file.models.FileManager');
		
		$dataprovider = FileManager::model()->findAll(array(
			'order'=>'position, date DESC',
			'condition'=>'model_id=:model_id AND model_name=:model_name AND file_type=:file_type',
			'params'=>array(':model_id'=>$this->id, ':model_name'=>'Porfolio_Beauty', ':file_type'=>'image')
		));
	
		$this->render('beauty', array('dataprovider'=>$dataprovider));
	}
}