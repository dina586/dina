<?php
class CRM {
	public static function getBreadcrumbs() {
		$breadcrumbs = array('Home'=>array('/site/index'));
		$breadcrumbs[] = Yii::app()->controller->pageTitle;
		return $breadcrumbs;
		
	}	

}