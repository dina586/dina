<?php
Yii::import('application.modules.carriers.models.Carriers');
//Виджет для вывода блоков на странице
class CarriersWidget extends CWidget {
		
    public function run() {
   		$this->view();
    }

	private function view() {
		//Yii::app()->clientScript->registerPackage('flexslider');
		$dataProvider = Carriers::model()->findAll(array('condition'=>'is_view=1'));
		
		$this->render('carriers_view', array(
			'dataProvider'=>$dataProvider,
		));
	}

}