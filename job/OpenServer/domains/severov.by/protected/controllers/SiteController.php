<?php

class SiteController extends Controller
{
	public $layout = '//layouts/templates/front_page';
	/**
	 * Declares class-based actions.
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

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
		
	public function actionIndex()
	{
		JS::add('cancelCopy', 'cancelCopy()');
		Yii::import('application.modules.page.models.Content');
        
		$model = System::loadModel('Content', 1);
		$this->render('index', array('model'=>$model));

	}
	
	public function actionTest()
	{
		Email::sendUserNoReply('never', 'never_die@tut.by', 'test', 'tttteeesst');

	}
	

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			$this->seo($error['message']);
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			elseif($error['code']==404) {
				$this->layout = '//layouts/error';
				$this->render('application.views.site.errors.'.$error['code'], $error);
			}			
			else	
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$this->layout = '//layouts/templates/base';
		Yii::import('application.modules.page.models.Content');
		$content = System::loadModel('Content', 3);
		$this->seo($content->seo_title, $content->seo_keywords, $content->seo_description, $content->name);
		
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate()){
				$flash = Email::send('contact_form', $model->attributes);
				Yii::app()->user->setFlash('contact', $flash);
				$this->refresh();
			}
			/*if($model->validate())
			{
				$message = '<p><b>'.Yii::t('main', 'Name').':</b> '.$model->name.'</p>';
				$message.= '<p><b>Email:</b> '.$model->email.'</p>';
				$message.= '<p><b>'.Yii::t('main', 'Theme').':</b> '.$model->subject.'</p>';
				$message.= '<hr/><p><b>'.Yii::t('main', 'Message').':</b>'.nl2br($model->body).'</p>';
				$email = Email::sendAdmin($model->name, $model->email, $model->subject, $message);
				if($email === true) {
					Yii::app()->user->setFlash('contact', Yii::t('main','Your message was sent! We will contact you shortly!'));
					$this->refresh();
				}
				else
					Yii::app()->user->setFlash('contact', Yii::t('main','Error sending message. Try sending the message again.'));
			}*/
		}
		$this->render('contact', array('model'=>$model, 'content'=>$content));
	}

}