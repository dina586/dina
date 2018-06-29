<?php

class ObjectsModule extends CWebModule
{
	public $defaultController = 'view';
	
	public function init()
	{
		$this->setImport(array(
			'objects.models.*',
			'objects.components.*',
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
