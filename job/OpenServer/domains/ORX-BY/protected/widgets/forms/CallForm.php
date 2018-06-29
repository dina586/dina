<?php
/**
 * @author Nicholas Kobets <wemadefoxnever@gmail.com>
 * @copyright 365-solutions.com
 * @license http://365-solutions.com/general-license
 */
class CallForm extends CFormModel {

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
			'phone' => Yii::t('admin', 'Контактный телефон'),
		);
	}

}
