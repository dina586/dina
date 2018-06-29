<?php

/**
 * @author Nicholas Kobets <wemadefoxnever@gmail.com>
 * @copyright 365-solutions.com
 * @license http://365-solutions.com/general-license
 */
Yii::import('application.widgets.forms.CallForm');

class CallFormWidget extends CWidget {

	public function run() {
		$this->view();
	}

	private function view() {
		if (!Yii::app()->request->isAjaxRequest)
			Yii::app()->clientScript->registerPackage('ajaxForm');
		
		JS::add('get_a_call', 'callForm("call")');
		
		$model = new CallForm();
			
		$this->render('application.widgets.views.call_form.dialog', array(
			'model' => $model,
		));
	}

}
