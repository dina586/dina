<?php
class AdminMenu extends CWidget {
	public $width = '1000px';
	public function init() {
    	$this->publishAssets();
    }
	
    public function run() {
    	
		$this->renderContent();
	}
    
	protected function renderContent() {
		$this->render('menu',
			array()
		);
	} 
	
	protected function publishAssets() {
		Yii::app()->clientScript->packages['admin_menu'] = array(
			'basePath'=>'ext.admin-menu.assets',
			'js' => array(
				'js/admin_menu.js',
			),
			'css' => array(
				'css/admin_menu.css',
			),
		);
		Yii::app()->clientScript->registerPackage('admin_menu');
    }
    
    
 
}