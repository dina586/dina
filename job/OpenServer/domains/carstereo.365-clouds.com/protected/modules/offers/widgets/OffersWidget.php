<?php
Yii::import('application.modules.offers.models.Offers');
//Виджет для вывода блоков на странице
class OffersWidget extends CWidget {
		
    public function run() {
   		$this->view();
    }

	private function view() {
		//Yii::app()->clientScript->registerPackage('flexslider');
		$dataProvider = Offers::model()->findAll(array('condition'=>'is_view=1'));
		
		$this->render('offers_view', array(
			'dataProvider'=>$dataProvider,
		));
	}

}