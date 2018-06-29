<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class ContactForm extends CFormModel
{
	public $name;
	public $email;
	public $subject;
	public $message;
	public $verifyCode;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			// name, email, subject and body are required
			array('name, email, subject, message', 'required'),
			// email has to be a valid email address
			array('email', 'email'),
			// verifyCode needs to be entered correctly
			//array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements()),
		);
		if (!(isset($_POST['ajax']) && $_POST['ajax']==='contact-form')) {
			array_push($rules,array('verifyCode', 'CaptchaExtendedValidator', 'allowEmpty'=>!CCaptcha::checkRequirements() || !extension_loaded('gd')));
		}
		return $rules;
	}

	/**
	 * Declares customized attribute labels.
	 * If not declared here, an attribute would have a label that is
	 * the same as its name with the first letter in upper case.
	 */
	public function attributeLabels()
	{
		return array(
			//'verifyCode'=>'Verification Code',
			'verifyCode'=>Yii::t('main', "Verification Code"),
			'name'=>Yii::t('main', 'Name'),
			'email'=>Yii::t('main', 'Email'),
			'subject'=>Yii::t('main', 'Theme'),
			'message'=>Yii::t('main', 'Message'),
		);
	}
}