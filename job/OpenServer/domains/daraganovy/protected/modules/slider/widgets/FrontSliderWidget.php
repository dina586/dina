<?php
Yii::import('application.modules.slider.models.FrontSlider');
//Виджет для вывода блоков на странице
class FrontSliderWidget extends CWidget {
		
    public function run() {
   		$this->view();
    }

	private function view() {
		//Yii::app()->clientScript->registerPackage('flexslider');
		$data = FrontSlider::model()->findAll(
		array(
			'order'=>'position',
		));
		
		$this->render('front_slider', array(
			'dataProvider'=>$data,
		));
	}

}