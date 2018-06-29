<?php

/**
 * @author Nicholas Kobets <wemadefoxnever@gmail.com>
 * @copyright 365-solutions.com
 * @license http://365-solutions.com/general-license
 */
class SiteController extends Controller {

	public $layout = '//layouts/templates/base';

	/**
	 * Выводит сообщения об ошибках
	 */
	public function actionError() {

		if ($error = Yii::app()->errorHandler->error) {

			if (Yii::app()->request->isAjaxRequest)
				if (DEV_MODE)
					echo $error['message'] . ' ' . $error['file'] . ' on line ' . $error['line'];
				else
					echo $error['message'];
			else {
				$displayMessage = System::getErrorMessage($error['code']);				
				$this->renderPartial('errors/default', array('error' => $error, 'displayMessage'=>$displayMessage));
			}
		}
	}

	/**
	 * Site Front Page
	 */
	public function actionIndex() {
		$this->layout = '//layouts/templates/base';
		$this->render('index');
	}

}
