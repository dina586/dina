<?php

class InvoiceModule extends CWebModule
{
	public $defaultController = 'view';
	
	public $status = array(0=>'Unpaid', 1=>'Paid');
	
	public $type = array(1=>'Product Payment', 2=>'Service Payment', 3=>'Video Classes Payment', 0=>'Custom');
	
	public $apiLogin = '89k4YjRr';
	public $apiKey = '9jx48dV73RmVQ5SJ';
	public $testMode = false;
	
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'invoice.models.*',
			'invoice.components.*',
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
