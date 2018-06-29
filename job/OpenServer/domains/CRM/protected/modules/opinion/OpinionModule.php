<?php

class OpinionModule extends CWebModule
{
	public $defaultController = 'view';
	
	public $folder = 'opinion';
	
	public function init()
	{
	
		$dir = Yii::getPathOfAlias('webroot').DS.'upload'.DS.'opinion';
		Yii::app()->cFile->createDir($dir);
		Yii::app()->cFile->set($dir, true)->setPermissions(Yii::app()->params['setFolderPermission']);

		$this->setImport(array(
			'opinion.models.*',
			'opinion.components.*',
		));
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			return true;
		}
		else
			return false;
	}
}
