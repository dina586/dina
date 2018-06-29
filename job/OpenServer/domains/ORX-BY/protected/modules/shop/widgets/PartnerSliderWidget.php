<?php

/**
 * @author Nicholas Kobets <wemadefoxnever@gmail.com>
 * @copyright 365-solutions.com
 * @license http://365-solutions.com/general-license
 */
Yii::import('application.modules.shop.models.*');
class PartnerSliderWidget extends CWidget {

     public function run() {
   		$this->view();
    }

	private function view() {
		
		$dataProvider = Partner::model()->findAll(array('condition'=>'is_view=1'));
		
		$this->render('partner_slider', array(
			'dataProvider'=>$dataProvider,
		));
	}
	
}
