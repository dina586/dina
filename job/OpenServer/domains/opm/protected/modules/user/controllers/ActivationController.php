<?php

class ActivationController extends Controller
{
	public $defaultAction = 'activation';
	public $layout='//layouts/templates/base';
	
	/**
	 * Activation user account
	 */
	public function actionActivation () {
		$this->seo(Yii::t('admin', 'Account activation'));
		$email = $_GET['email'];
		$activkey = $_GET['activkey'];
		if ($email&&$activkey) {
			$find = User::model()->notsafe()->findByAttributes(array('email'=>$email));
			if (isset($find)&&$find->status) {
			    $this->render('/user/message',array('title'=>UserModule::t("User activation"),'content'=>UserModule::t("You account is active.").' <a href = "'.Yii::app()->createUrl('user/login').'">'.Yii::t('admin', 'Back to login form').'</a>'));
			} elseif(isset($find->activkey) && ($find->activkey==$activkey)) {
				$find->activkey = UserModule::encrypting(microtime());
				$find->status = 1;
				$find->save();
				$content = UserModule::t("You account is activated.").' <a href = "'.Yii::app()->createUrl('user/login').'">'.Yii::t('admin', 'Back to login form').'</a>';
			    $this->render('/user/message',array('title'=>UserModule::t("User activation"),'content'=>$content));
			} else {
			    $this->render('/user/message',array('title'=>UserModule::t("User activation"),'content'=>UserModule::t("Incorrect activation URL.")));
			}
		} else {
			$this->render('/user/message',array('title'=>UserModule::t("User activation"),'content'=>UserModule::t("Incorrect activation URL.")));
		}
	}

}