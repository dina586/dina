<?php
Yii::import('application.modules.file.models.FileManager');

class FileManagerBehavior extends CActiveRecordBehavior {
	
	public function afterSave($event){
		$modelName = get_class($this->owner);
		
		if($this->owner->isNewRecord) {
		
			if(Yii::app()->user->hasState('file_manager_folder_'.$modelName))
				$folderName = Yii::app()->user->getState('file_manager_folder_'.$modelName);
			else
				$folderName = Yii::app()->getModule('file')->generateName(Yii::getPathOfAlias('webroot').DS.'upload'.DS.Yii::app()->getModule('file')->uploadFolder);
						
			FileManager::model()->updateAll(
				array('model_id'=>$this->owner->id),
				'model_id=:model_id AND model_name=:model_name AND folder=:folder',
				array(':model_id'=>-1, ':model_name'=>$modelName, ':folder'=>$folderName)
			);
			
			if(Yii::app()->user->hasState('file_manager_folder_'.$modelName))
				Yii::app()->user->setState('file_manager_folder_'.$modelName, null);
		}
		
	}
	
	public function afterDelete($event){
		$modelName = get_class($this->owner);
		
		$model = FileManager::model()->find(array(
			'condition'=>'model_id=:model_id AND model_name=:model_name',
			'params'=>array(':model_id'=>$this->owner->id, ':model_name'=>$modelName)
		));
		
		if($model !== null) {
			$dir = Yii::getPathOfAlias('webroot').DS.'upload'.DS.Yii::app()->getModule('file')->uploadFolder.DS.$model->folder;
			Yii::app()->cFile->set($dir)->delete();
		}
		
		FileManager::model()->deleteAll(array(
			'condition'=>'model_id=:model_id AND model_name=:model_name',
			'params'=>array(':model_id'=>$this->owner->id, ':model_name'=>$modelName)
		));
	}
	
}