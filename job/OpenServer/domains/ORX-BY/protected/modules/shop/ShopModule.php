<?php

class ShopModule extends CWebModule
{
	public $defaultController = 'Catalog';
	
	public $thumbnailWidth = 675;
	public $thumbnailHeight = 391;
	
	public $catalogWidth = 225;
	public $catalogHeight = 108;
	
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'shop.models.*',
			'shop.components.*',
		));
		$this->publishAssets();
	}
	
	protected function publishAssets() {
        Yii::app()->clientScript->registerScriptFile(
		    Yii::app()->assetManager->publish(
		        Yii::getPathOfAlias('application.modules.shop.assets.js').'/shop.js'
		    ),
		   	CClientScript::POS_HEAD
		);
			
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
