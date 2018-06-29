<?php

class ExcelModule extends CWebModule
{
	//Номер строки для считывания
	public $startRow = 2;
	
	//Количество считываемых строк за раз
	public $chunkSize = 50;
	
	
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'excel.models.*',
			'excel.components.*',
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
