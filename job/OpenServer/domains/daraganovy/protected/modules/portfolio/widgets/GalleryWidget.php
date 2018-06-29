<?php
class GalleryWidget extends CWidget {
	public $id;
	public $cover = true;
	public function run() {
		Yii::import('application.modules.file.models.FileManager');
		if($this->cover == true)
			$condition = '';
		else
			$condition = ' AND cover = 0';
		$dataprovider = FileManager::model()->findAll(array(
			'order'=>'position, date DESC',
			'condition'=>'model_id=:model_id AND model_name=:model_name AND file_type=:file_type'.$condition,
			'params'=>array(':model_id'=>$this->id, ':model_name'=>'Portfolio', ':file_type'=>'image')
		));
	
		$this->render('gallery', array('dataprovider'=>$dataprovider));
	}
}