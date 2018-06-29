<?php

/**
 * @author Nicholas Kobets <wemadefoxnever@gmail.com>
 * @copyright 365-solutions.com
 * @license http://365-solutions.com/general-license
 */
Yii::import('application.widgets.forms.OrderForm');

class OrderFormWidget extends CWidget {

	public function run() {
		$this->view();
	}

	private function view() {
		if (!Yii::app()->request->isAjaxRequest)
			Yii::app()->clientScript->registerPackage('ajaxForm');
		JS::add('formSubmit', 'formSubmit(".d-content")');
		$model = new OrderForm();
			
		$this->render('application.widgets.views.call_form._form', array(
			'model' => $model,
			'id'=>'b-order_form',
			'class'=>'a-button'
		));
	}

}
