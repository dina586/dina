<?php

class HelperModule extends CWebModule
{
	//Выбор количества элементов для отображения в grid
	public $gridPager = array(10=>10, 20=>20, 30=>30, 50=>50, 100=>100, 200=>200, 300=>300);
	public function init()
	{
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
			if(!Yii::app()->request->isAjaxRequest)
				$this->publishAssets();
			
			return true;
		}
		else
			return false;
	}
	/*Регистрируем пакет для модуля*/
	protected function publishAssets() {
		Yii::app()->clientScript->packages['helper'] = array(
			'basePath'=>'application.modules.helper.assets',
			'js' => array(
				'helper.jquery.js',
			),
			'depends'=>array('jquery'),
		);
		Yii::app()->clientScript->registerPackage('helper');
    }
}
