<?php
Yii::import('application.modules.invite.models.Invite');
/**
 * RegistrationForm class.
 * RegistrationForm is the data structure for keeping
 * user registration form data. It is used by the 'registration' action of 'UserController'.
 */
class RegistrationForm extends User {
	public $verifyPassword;
	public $verifyCode;
	public $invite;
	
	public function rules() {
		$rules = array(
			array('username, password, verifyPassword, email', 'required'),
			array('username', 'length', 'max'=>20, 'min' => 3,'message' => UserModule::t("Incorrect username (length between 3 and 20 characters).")),
			array('password', 'length', 'max'=>128, 'min' => 4,'message' => UserModule::t("Incorrect password (minimal length 4 symbols).")),
			array('email', 'email'),
			array('username', 'unique', 'message' => UserModule::t("This user's name already exists.")),
			array('email', 'unique', 'message' => UserModule::t("This user's email address already exists.")),
			//array('verifyPassword', 'compare', 'compareAttribute'=>'password', 'message' => UserModule::t("Retype Password is incorrect.")),
			array('username', 'match', 'pattern' => '/^[A-Za-z0-9_]+$/u','message' => UserModule::t("Incorrect symbols (A-z0-9).")),
			
		);
		if (!(isset($_POST['ajax']) && $_POST['ajax']==='registration-form')) {
			array_push($rules,array('verifyCode', 'CaptchaExtendedValidator', 'allowEmpty'=>!CCaptcha::checkRequirements() || !extension_loaded('gd')));
		}
		
		array_push($rules,array('verifyPassword', 'compare', 'compareAttribute'=>'password', 'message' => UserModule::t("Retype Password is incorrect.")));
		return $rules;
	}
	
	
	/**
	* Валидация инвайта при регистрации
	*/
	public function inviteCheck($attribute) {
		if(Invite::model()->count('invite=:invite', array(':invite'=>$this->invite)) == 0) {
			$message = strtr('Данный {attribute} не существует', array('{attribute}'=>$this->getAttributeLabel($attribute)));
			$this->addError($attribute, $message);
		}
		if(Invite::model()->count('invite=:invite AND id_user_used != 0', array(':invite'=>$this->invite)) != 0) {
			$message = strtr('Данный {attribute} уже был использован', array('{attribute}'=>$this->getAttributeLabel($attribute)));
			$this->addError($attribute, $message);
		}		
	}
	
}