<?php

/**
 * @author Nicholas Kobets <wemadefoxnever@gmail.com>
 * @copyright 365-solutions.com
 * @license http://365-solutions.com/general-license
 */
Yii::import('application.widgets.forms.OrderForm');

class OrderWidget extends CWidget {

	public function run() {
		$this->view();
	}

	private function view() {
		if (!Yii::app()->request->isAjaxRequest)
			Yii::app()->clientScript->registerPackage('ajaxForm');
		
		JS::add('order_form', 'callForm("order")');
	
		$model = new OrderForm();
			
		$this->render('application.widgets.views.order_form.dialog', array(
			'model' => $model,
		));
	}

}
