<?php
/**
 * @author Nicholas Kobets <wemadefoxnever@gmail.com>
 * @copyright 365-solutions.com
 * @license http://365-solutions.com/general-license
 */
class ExtraForm extends CFormModel {

	public $name;
	public $phone;
	public $email;
	public $company;

	public function rules() {
		$rules = array(
			['name, phone, email, company', 'required'],
			['email', 'email'],
		);
		return $rules;
	}

	public function attributeLabels() {
		return array(
			'name' => Yii::t('admin', 'Имя'),
			'phone' => Yii::t('admin', 'Телефон'),
			'email' => Yii::t('admin', 'E-mail'),
			'company' => Yii::t('admin', 'Компания'),
		);
	}

}
