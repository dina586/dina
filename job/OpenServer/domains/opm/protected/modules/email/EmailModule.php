<?php

class EmailModule extends CWebModule
{
	public $emailFor;
	
	public $tagType;
	
	public function init()
	{
		
		$this->emailFor = array(
			1=>Yii::t('admin','For admin'), 
			2=>Yii::t('admin','For user'),
		);
		
		$this->tagType = array(
			1=>Yii::t('admin','Simple text'), 
			2=>Yii::t('admin','Link'), 
			3=>Yii::t('admin','HTML'), 
			4=>Yii::t('admin','HTML table'), 
		);
		
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'email.models.*',
			'email.components.*',
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
