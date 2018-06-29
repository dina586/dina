<?php

class HelperModule extends CWebModule
{
	//Выбор количества элементов для отображения в grid
	public $gridPager = array(10=>10, 20=>20, 30=>30, 50=>50, 100=>100, 200=>200, 300=>300);
	
	//Переменная для отображения или сокрытия разделов/материалов на сайте
	public $isView;
	
	public $settingsFields = array('input'=>'input', 'textarea'=>'textarea', 'editor'=>'editor');
	
	public $settingsModules;
	
	public function init()
	{
		$this->isView = array(0=>Yii::t('admin', 'Hidden'), 1=>Yii::t('admin', 'Display'));
		
		$this->settingsModules = array(
			1=>Yii::t('admin','Base module'), 
			2=>Yii::t('admin','Email Settings'),
			3=>Yii::t('admin','User Module'),
			4=>Yii::t('admin','SEO Settings'),
			5=>Yii::t('admin','Payment'),
			10=>Yii::t('admin','Social Networks'),
		);
		
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'helper.models.*',
			'helper.components.*',
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
