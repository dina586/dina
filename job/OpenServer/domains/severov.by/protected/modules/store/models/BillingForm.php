<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class BillingForm extends CFormModel
{
	public $name;
	public $lastname;
	public $address;
	public $address2;
	public $city;
	public $state;
	public $zip;
	public $country;
	public $email;
	public $body;
	public $verifyCode;
	public $phone;
	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			// name, email, subject and body are required
			array('name, lastname, address, city, country, email', 'required'),
			array('address2, zip, phone, state', 'safe'),
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
			'name'=>'First Name',
			'lastname' => 'Last Name',
			'email'=>'Email',
			'address' => 'Address 1',
			'address2' => 'Address 2 (Optional)',
			'city'=>'City',
			'state'=>'State or Prov.',
			'zip'=>'Zip/Postal Code',
			'country'=>'Country',
			'phone'=>'Phone',
			'subject'=>'Theme',
			'body'=>'Additional info',
	
		);
	}
	
}