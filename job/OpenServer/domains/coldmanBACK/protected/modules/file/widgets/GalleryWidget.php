<?php
/**
 * @author Nicholas Kobets <wemadefoxnever@gmail.com>
 * @copyright 365-solutions.com
 * @license http://365-solutions.com/general-license
 */
class GalleryWidget extends CWidget {
	public $id;
	public $modelName;
	public $type = 'thumbnail';
	
	public function run() {
		Yii::app()->clientScript->registerPackage('galleria');
		Yii::import('application.modules.file.models.FileManager');
		
		$dataprovider = FileManager::model()->findAll(array(
			'order'=>'position, date DESC',
			'condition'=>'model_id=:model_id AND model_name=:model_name AND file_type=:file_type',
			'params'=>array(':model_id'=>$this->id, ':model_name'=>$this->modelName, ':file_type'=>'image')
		));
	
		$this->render('gallery', array('dataprovider'=>$dataprovider));
	}
}