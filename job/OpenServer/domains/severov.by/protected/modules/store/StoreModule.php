<?php

class StoreModule extends CWebModule
{
	public $defaultController = 'catalog';
	
	public $folder = 'store';
	
	public $catalogFolder = 'catalog';

	//Количество товара для вывода в ряд
	public $productPerRow = 4;
	
	//Количество товара для вывода на страницу
	public $itemsPerPage = 20;
	
	public $orderStatus;
	
	public $orderPayment;
	
	public $orderIsPaid;
		
	public function init()
	{
		if($this->orderStatus == '')
			$this->orderStatus = array(1=>Yii::t('main', 'New'), 2=>Yii::t('shop', 'In Progress'), 3=>Yii::t('main', 'Complete'));
		$this->orderPayment = array(0=>Yii::t('shop','Not available'));
		$this->orderIsPaid = array(0=>Yii::t('shop','Not paid'), 1=>Yii::t('shop','Paid'));
		
		
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'store.models.*',
			'store.components.*',
		));
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			if(!Yii::app()->request->isAjaxRequest) {
				Yii::app()->clientScript->registerPackage('store');
			}
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}
}
