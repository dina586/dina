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
        
         public function actions()
	{
		return array(
			'captcha'=>array(
                'class'=>'CaptchaExtendedAction',
                // if needed, modify settings
            ),
		);
	}
        
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

		Yii::import('application.modules.page.models.Page');
		$model = System::loadModel('Page', 1);
		$this->seo($model->title, $model->keywords, $model->description, $model->name);
		$this->render('index', array('model'=>$model));
	}

	public function actionContact()
	{
		$this->pageTitle = 'Get In Touch With MJ Car Stereo | Orange, CA';
		Yii::import('application.modules.page.models.Page');
		$content = System::loadModel('Page', 2);
		$this->seo($content->title, $content->keywords, $content->description, $content->name);
		
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			$data = $model->attributes;
			$data['message'] = $model->body;
			if($model->validate()){
				$flash = Email::send('contact_form', $data);
				Yii::app()->user->setFlash('contact', $flash);
				$this->refresh();
			}
			
		}
		$this->render('contact', array('model'=>$model, 'content'=>$content));
	}
}
