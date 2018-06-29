<?php
class FormWidget extends CWidget {
	
	public $id;
	public $modelName;
	public $cover = true;
	
	public function run() {
		Yii::app()->getClientScript()->registerCoreScript('jquery.ui');
		JS::add('jquery-ui-sortable', "$('#d-file_manager_items').sortable({'delay':'300','deactivate':function(event, ui ) { sendImagesPosion();}});");
		Yii::import('application.modules.file.models.FileManager');
		
		$criteria = FileManager::getSearchCriteria($this->id, $this->modelName);
		$criteria->order = 'position, date DESC';
		
		if($this->id < 0) {
			if(Yii::app()->user->hasState('file_manager_folder_'.$this->modelName))
				$folderName = Yii::app()->user->getState('file_manager_folder_'.$this->modelName);
			else
				$folderName = Yii::app()->getModule('file')->generateName(Yii::getPathOfAlias('webroot').DS.'upload'.DS.Yii::app()->getModule('file')->uploadFolder);
			$criteria->compare('folder', $folderName, true);
		}
		
		$dataprovider = FileManager::model()->findAll($criteria);
		
		$this->render('form', array('dataprovider'=>$dataprovider));
	}
}