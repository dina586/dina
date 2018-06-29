<?php
Yii::import('application.modules.stock.models.Stock');
//Виджет для вывода блоков на странице
class ViewSlider extends CWidget {
		
    public function run() {
   		$this->view();
    }

	private function view() {
		$data = Stock::model()->findAll(
		array(
			'condition'=>'is_view = 1',
			'order'=>'position',
		));
		
		$this->render('slider', array(
			'dataProvider'=>$data,
		));
	}

}