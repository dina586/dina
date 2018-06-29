<?php

/*Виджет для вывода слайдера*/
class ShopSlider extends CWidget {
	
	/*Выбор типа слайдера*/
	public $sliderType = 'popular';
	
    public function run() {
   		$this->viewSlider();
   		Yii::app()->clientScript->registerPackage('shop');
   		Yii::app()->clientScript->registerPackage('jcarousel');
    }

	private function viewSlider() {
		$field = $this->sliderType;
		$data = Product::model()->findAll(array('condition'=>''.$field.'=1 AND is_view = 1', 'limit'=>16));
		$this->render('slider', array(
			'dataProvider'=>$data,
		));
	}
}