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
                'mode'=>CaptchaExtendedAction::MODE_MATH,
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
		$this->layout = '//layouts/main';
		Yii::import('application.modules.page.models.Page');
		$model = System::loadModel('Page', 1);
		$this->seo($model->title, $model->keywords, $model->description, $model->name);
		Yii::app()->clientScript->registerPackage('revolution_slider');
		Yii::app()->clientScript->registerPackage('flexslider');
		Yii::app()->clientScript->registerPackage('bxsLider');
		JS::add('front_slider', 'front_slider()');
		$this->render('index', array('model'=>$model));
	}
        
        public function actionContact()
	{
		//$this->layout = '//layouts/templates/base';
                $this->pageTitle = 'Контакты'; 
		Yii::import('application.modules.page.models.Page');
		$content = System::loadModel('Page', 2);
		$this->seo($content->title, $content->keywords, $content->description, $content->name);
		
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate()){
				$flash = Email::send('contact_form', $model->attributes);
				Yii::app()->user->setFlash('contact', $flash);
				$this->refresh();
			}
			
		}
		$this->render('contact', array('model'=>$model, 'content'=>$content));
		
	}


}
