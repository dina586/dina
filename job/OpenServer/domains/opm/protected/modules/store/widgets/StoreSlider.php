<?php

/*Виджет для вывода слайдера*/
class StoreSlider extends CWidget {
	
	/*Выбор типа слайдера*/
	public $sliderType = 'popular';
	
    public function run() {
   		$this->viewSlider();
   		Yii::app()->clientScript->registerPackage('store');
   		Yii::app()->clientScript->registerPackage('jcarousel');
    }

	private function viewSlider() {
		$data = Product::model()->findAll(array('condition'=>''.$this->sliderType.'=1 AND is_view = 1', 'limit'=>16));
		
		$this->render('slider', array(
			'dataProvider'=>$data,
		));
	}
}