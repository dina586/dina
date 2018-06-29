<?php

class RegistrationController extends Controller
{
	public $defaultAction = 'registration';
	public $layout='//layouts/site';
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
	 * Registration user
	 */
	public function actionRegistration() {
		$this->seo(Yii::t('admin', 'Registration'));
		
		Yii::app()->getModule('user')->registerJS();
		
		
		$model = new RegistrationForm;
		$profile=new Profile;
		$profile->regMode = true;
            
		if(isset($_POST['ajax']) && $_POST['ajax']==='registration-form')
		{
			echo UActiveForm::validate(array($model,$profile));
			Yii::app()->end();
		}
			
		if (Yii::app()->user->id) {
		   	$this->redirect(Yii::app()->controller->module->profileUrl);
		} else {
		    if(isset($_POST['RegistrationForm'])) {
				$model->attributes=$_POST['RegistrationForm'];
				$profile->attributes=((isset($_POST['Profile'])?$_POST['Profile']:array()));
				if($model->validate()&&$profile->validate())
				{
					$soucePassword = $model->password;
					$model->activkey=UserModule::encrypting(microtime().$model->password);
					$model->password=UserModule::encrypting($model->password);
					$model->verifyPassword=UserModule::encrypting($model->verifyPassword);
					$model->status=((Yii::app()->controller->module->activeAfterRegister)?User::STATUS_ACTIVE:User::STATUS_NOACTIVE);
						
					//Стартуем транзакции чтобы убедиться в целостности данных
					$transaction = Yii::app()->db->beginTransaction();
					try {
						//Сохраняем все данные
						$model->save(false);
						$profile->user_id=$model->id;
						$profile->save();
						
						$data['EMAIL'] = $model->email;
						$data['login'] = $model->username;
						$data['activation_url'] = '<a href = "'.$this->createAbsoluteUrl('/user/activation/activation',array("activkey" => $model->activkey, "email" => $model->email)).'">'.Yii::t('admin', 'account activation').'</a>';
						
						$flash = Email::send('registration', $data, $profile->lastname.' '.$profile->firstname, $model->email);
						Yii::app()->user->setFlash('registration', $flash);
						
						if ($transaction->commit()) {}
							
						$this->refresh();
					}
					catch(Exception $e) {
						$transaction->rollback();							
					}
				}
			}
			$this->render('/user/registration',array('model'=>$model,'profile'=>$profile));
		}
	}
	
	private function setUserRoles($id){
		
		$roles = new Roles;
		$roles -> isNewRecord = true;
		$roles->user_id = $id;
		$roles->role = 'user';
		$roles->operations = '';
		return $roles;
	}
	

}