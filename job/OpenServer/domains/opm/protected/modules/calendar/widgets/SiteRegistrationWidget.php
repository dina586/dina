<?php

class SiteRegistrationWidget extends CWidget {
	
	public function run() {

		Yii::import('application.modules.user.models.*');
		$model = new QuickRegistration;
		
		Yii::app()->clientScript->registerPackage('mask');
		Yii::app()->clientScript->registerPackage('ajaxForm');
		JS::add('mobilemask', '$(".j-mobile_field").mask("(999) 999-9999");');
		
		$this->render('site_registration', array('model'=>$model));
	}
}