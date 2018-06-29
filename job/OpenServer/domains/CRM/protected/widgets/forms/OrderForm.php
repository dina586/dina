<?php
/**
 * @author Nicholas Kobets <wemadefoxnever@gmail.com>
 * @copyright 365-solutions.com
 * @license http://365-solutions.com/general-license
 */
class OrderForm extends CFormModel {

	public $name;
	public $phone;

	public function rules() {
		$rules = array(
			['name, phone', 'required'],
		);
		return $rules;
	}

	public function attributeLabels() {
		return array(
			'name' => Yii::t('admin', 'Ваше имя'),
			'phone' => Yii::t('admin', 'Ваш телефон'),
		);
	}

}
