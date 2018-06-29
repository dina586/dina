<?php
Yii::import('application.modules.portfolio.models.Portfolio');

class SiteGalleryWidget extends CWidget {
	
	public $type;
	
	public function run() {
		
		$dataProvider = Portfolio::model()->findAll(array('condition'=>'radiobutton='.$this->type, 'limit'=>5));
		$this->render('sitegallery', array('dataProvider'=>$dataProvider));
	
	}
}
