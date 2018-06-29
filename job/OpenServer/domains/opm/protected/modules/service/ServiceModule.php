<?php

class ServiceModule extends CWebModule
{
	public $defaultController = 'view';
	
	public $folder = 'service';
	
	public $contract = array(0=>'No Contract', 1 => 'Organic Permanent Makeup Consent Form', 2=>'Botox Consent', 3=>'Dermal Filler Consent Form', 4=>'IPL Hair Removal Consent Form');
	
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'service.models.*',
			'service.components.*',
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
