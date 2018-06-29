<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class CartForm extends CFormModel
{
	//Billing data
	public $firstname;
	public $lastname;
	public $address;
	public $city;
	public $state;
	public $zip;
	public $country;
	public $user_id;
	
	//Contact data
	public $email;
	public $comment;
	public $phone;
	
	public $international;
	public $us_shipping;
	public $int_shipping;
	
	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			// name, email, subject and body are required
			array('firstname, lastname, address, city, email, international, address, country, zip', 'required'),
			array('comment, us_shipping, int_shipping, state, zip, user_id, phone', 'safe'),
			array('us_shipping, state', 'required', 'on'=>'us_shipping'),
			array('int_shipping', 'required', 'on'=>'int_shipping'),
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
			'firstname'=>'First Name',
			'lastname'=>'Last Name',
			'address'=>'Adress',
			'city'=>'City',
			'state'=>'State',
			'zip'=>'Zip/Postal Code',
			'country'=>'Country',
			'email'=>'Email',
			'comment'=>'Comment',
			'phone'=>'Phone',
			'address'=>'Address',
			'international'=>'International Purchase',
			'us_shipping'=>'US Shipping',
			'int_shipping'=>'International Shipping',
		);
	}

}