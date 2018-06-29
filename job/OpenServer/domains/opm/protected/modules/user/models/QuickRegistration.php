<?php

Yii::import('application.modules.helper.models.*');

class QuickRegistration extends CFormModel
{
	public $firstname;
	public $lastname;
	public $address;
	public $city;
	public $state;
	public $zip;
	public $country;

	public $email;
	public $phone;
	
	public $state_id;
	public $city_id;
	public $country_id;
	
	
	
	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			array('firstname, lastname, email, phone', 'required'),
			array('state, zip, city, country, address, city_id, country_id', 'safe'),
			array('city, country', 'checkExist'),
			array('email', 'email'),
		);
	}
	
	public function checkExist($attribute) {
		$searchAttr = trim($attribute, '_id');
		$model =  ucfirst($searchAttr);
		if($this->$searchAttr != '') {
			if($model::model()->count($searchAttr.'_name_en=:search', array(':search'=>$this->{$searchAttr})) == 0) {
				$message = strtr('This {attribute} does not exists in database. Please, select correct {attribute}', array('{attribute}'=>$this->getAttributeLabel($attribute)));
				$this->addError($attribute, $message);
			}
		}

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
			'city_id'=>'City',
			'country_id'=>'Country',
			'state'=>'State',
			'zip'=>'Zip/Postal Code',
			'country'=>'Country',
			'email'=>'Email',
			'comment'=>'Comment',
			'phone'=>'Phone',
			'address'=>'Address',
		);
	}
	
	public function afterValidate() {
		$city = City::model()->find('city_name_en=:city_name_en', array('city_name_en'=>$this->city));
		if($city !== null)
			$this->city_id = $city->id;
		else 
			$this->city_id = 0;
		
		$country = Country::model()->find('country_name_en=:country_name_en', array('country_name_en'=>$this->country));
		if($country !== null)
			$this->country_id = $country->id;
		else
			$this->country_id = 0;
		
		$state = UsaStates::model()->find('state_abbreviation=:state_abbreviation', array('state_abbreviation'=>$this->state));
		if($state !== null)
			$this->state_id = $state->id;
		else
			$this->state_id = 1;
		
		parent::afterValidate();
		return true;
	}
	

}