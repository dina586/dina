<?php

/**
 * @author Nicholas Kobets <wemadefoxnever@gmail.com>
 * @copyright 365-solutions.com
 * @license http://365-solutions.com/general-license
 */
class OpinionWidget extends CWidget {
	
	public function run() {
		Yii::import('application.modules.opinion.models.*');
		$dataProvider = Opinion::model()->findAll(['order'=>'position', 'condition'=>'is_view=1']);
		Yii::app()->clientScript->registerPackage('jcarousel');
		JS::add('jcarousel_opinion', 'jcarousel_init(".j-jcarousel_opinion", 20000)');	
		
		$this->render('opinion', ['dataProvider'=>$dataProvider]);
	}
}
