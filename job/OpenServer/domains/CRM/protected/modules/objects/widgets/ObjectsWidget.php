<?php

/**
 * @author Nicholas Kobets <wemadefoxnever@gmail.com>
 * @copyright 365-solutions.com
 * @license http://365-solutions.com/general-license
 */
class ObjectsWidget extends CWidget {
	
	public function run() {
		Yii::import('application.modules.objects.models.*');
		$dataProvider = Objects::model()->findAll(['order'=>'position']);
		
		$this->render('object', ['dataProvider'=>$dataProvider]);
	}
}
