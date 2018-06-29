<?php

class PrivForm extends CFormModel
{
	public $name;
	public $organization;
	public $unp;
	public $city;
	public $email;
	public $comment;
	public $phone;
	
	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			// name, email, subject and body are required
			array('email, phone, organization, unp', 'required'),
			array('name, comment, city', 'safe'),
			// email has to be a valid email address
			array('email', 'email'),
			// verifyCode needs to be entered correctly
			//array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements()),
		);
	}

	/**
	 * Declares customized attribute labels.
	 * If not declared here, an attribute would have a label that is
	 * the same as its name with the first letter in upper case.
	 */
	public function attributeLabels()
	{
		return array(
			'name'=>'Имя',
			'phone'=>'Телефон',
			'organization'=>'Организация',
			'unp'=>'УНП',
			'city'=>'Город',
			'email'=>'Email',
			'comment'=>'Комментарий',
			'phone'=>'Телефон',
		);
	}
	
}