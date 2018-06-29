<?php

class OpinionModule extends CWebModule
{
	public $defaultController = 'view';
	
	public $folder = 'opinion';
	
	public $isNew = array(1=>'Новый', 0=>'Утвержден');
	
	public $viewOnMain = array(1=>'Выводится на главной', 0=>'Не выводится');
	
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'opinion.models.*',
			'opinion.components.*',
		));
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}
}
