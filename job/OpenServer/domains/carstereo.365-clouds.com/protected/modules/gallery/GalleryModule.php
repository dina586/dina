<?php

class GalleryModule extends CWebModule
{
    public $defaultController = 'view';
	
	public $folder = 'gallery';
   
        public $original = array('width' => '960', 'height' => '720', 'type' => 'auto');
	public $noImage = 'no-img.png';
	public $uploadFolder = 'file_manager';
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'gallery.models.*',
			'gallery.components.*',
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
