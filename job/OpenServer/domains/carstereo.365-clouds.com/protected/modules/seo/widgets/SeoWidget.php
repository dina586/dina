<?php

Yii::import('application.modules.seo.models.SeoModel');

/**
 * @author Nicholas Kobets <wemadefoxnever@gmail.com>
 * @copyright 365-solutions.com
 * @license http://365-solutions.com/general-license
 */
class SeoWidget extends CWidget {

	public $id;
	public $modelName;
	public $form;

	public function run() {
		$model = new SeoModel();
		$model = SeoModel::getModel($this->id, $this->modelName);
		
		if($model === null)
			$model = new SeoModel();
		$this->render('seo_form', array('form'=>$this->form, 'model'=>$model));
	}

}
