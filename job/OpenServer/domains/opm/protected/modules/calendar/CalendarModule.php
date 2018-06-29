<?php

class CalendarModule extends CWebModule {

	public function init() {
		$this->setImport(array(
			'calendar.models.*',
			'calendar.components.*',
		));
	}

	public function beforeControllerAction($controller, $action) {
		if (parent::beforeControllerAction($controller, $action)) {
			return true;
		} else
			return false;
	}

}
