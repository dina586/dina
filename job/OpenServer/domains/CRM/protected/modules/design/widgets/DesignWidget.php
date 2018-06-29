<?php

/**
 * @author Nicholas Kobets <wemadefoxnever@gmail.com>
 * @copyright 365-solutions.com
 * @license http://365-solutions.com/general-license
 */
class DesignWidget extends CWidget {
	
	public $border = array(
		'ffd33b',
		'f61e84',
		'4664aa',
		'12cd94',
		'31aacd',
		'b9c4ff',
		'eb5f78',
		'f5a00a',
		'',
		'',
	);
	
	public function run() {
		Yii::import('application.modules.design.models.*');
		
		
		$this->render('design');
	}
}
