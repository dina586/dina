<?php
Yii::import('application.modules.chance.models.Chance');
//Виджет для вывода блоков на странице
class ChanceWidget extends CWidget {
		
    public function run() {
   		$this->view();
    }

	private function view() {
		//Yii::app()->clientScript->registerPackage('flexslider');
		$dataProvider = Chance::model()->findAll(array('condition'=>'is_view=1'));
		
		$this->render('chance_view', array(
			'dataProvider'=>$dataProvider,
		));
	}

}