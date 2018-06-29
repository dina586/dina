<?php

/**
 * @author Nicholas Kobets <wemadefoxnever@gmail.com>
 * @copyright 365-solutions.com
 * @license http://365-solutions.com/general-license
 */
class DefaultController extends Controller {

	public function filters() {
		return array(
			'accessControl',
			'postOnly + delete',
		);
	}

	public function accessRules() {
		return array(
			array('allow',
				'actions' => array('getCall'),
				'users' => array('*'),
			),
			array('deny',
				'users' => array('*'),
			),
		);
	}

	/**
	 * Заказать звонок - отправка сообщения на емейл
	 */
	public function actionGetCall() {
		Yii::import('application.widgets.forms.CallForm');
		if (!Yii::app()->request->isAjaxRequest)
			$this->redirect('/site/index');

		$model = new CallForm();
		$json = ['status' => 'error', 'message' => 'Error while email sending. Please, write to '.Settings::getVal('admin_email')];

		if (isset($_POST['CallForm'])) {			
			$model->attributes = $_POST['CallForm'];
			if($model->validate()){
				$data = $model->attributes;
				$data['email'] = 'noreply@mail.com';
				$json['message'] = Email::send('get_a_call', $data);
				$json['status'] = 'ok';
			}
			else{
				$json['message'] = print_r($model->getErrors());
			}
		}
		
		echo json_encode($json);
		
	}

}
