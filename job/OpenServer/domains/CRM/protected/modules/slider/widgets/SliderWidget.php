<?php

/**
 * @author Nicholas Kobets <wemadefoxnever@gmail.com>
 * @copyright 365-solutions.com
 * @license http://365-solutions.com/general-license
 */
class SliderWidget extends CWidget {
	
	public function run() {
		Yii::import('application.modules.slider.models.*');
		$dataProvider = Slider::model()->findAll(['order'=>'position']);
		Yii::app()->clientScript->registerPackage('jcarousel');
		JS::add('jcarousel_slider', 'jcarousel_init(".j-jcarousel_slider", 3000)');	
		
		$this->render('slider', ['dataProvider'=>$dataProvider]);
	}
}
