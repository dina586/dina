<?php

class DesignModule extends CWebModule
{
	public $defaultController = 'view';
	public $catalog = [
		0=>'Освещение', 
		1=>'Климат-контроль', 
		2=>'Управление электроприводами',
		3=>'Интеграция домофонной системы и IP-камер', 
		4=>'Сбор информации',
		5=>'Управление техникой в доме',
		6=>'Контроль и оповещение об аварийных ситуациях',
		7=>'Мультирум',
	];
	public function init()
	{
		$this->setImport(array(
			'design.models.*',
			'design.components.*',
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
