<?php
/**
 * @author Nicholas Kobets <wemadefoxnever@gmail.com>
 * @copyright 365-solutions.com
 * @license http://365-solutions.com/general-license
 */
class FileRenderWidget extends CWidget {
	public $id;
	
	public $modelName;
	
	public function run() {
		if(!Yii::app()->request->isAjaxRequest)
			Yii::app()->clientScript->registerPackage('photobox');
		Yii::import('application.modules.file.models.FileManager');

		$dataprovider = FileManager::model()->findAll(array(
			'order'=>'position, date DESC',
			'condition'=>'model_id=:model_id AND model_name=:model_name AND file_type=:file_type',
			'params'=>array(':model_id'=>$this->id, ':model_name'=>$this->modelName, ':file_type'=>'file')
		));
	
		$this->render('file', array('dataprovider'=>$dataprovider));
	}
}