<?php

class SliderModule extends CWebModule
{
	public $defaultController = 'view';
	
	public $folder = 'slider';
	
	public function init()
	{
		$this->setImport(array(
			'slider.models.*',
			'slider.components.*',
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
