<?php
/**
 * @author Nicholas Kobets <wemadefoxnever@gmail.com>
 * @copyright 365-solutions.com
 * @license http://365-solutions.com/general-license
 */
class OrderForm extends CFormModel {

	public $name;
	public $phone;
	public $date;
	public $time;
	public $problem;

	public function rules() {
		$rules = array(
			['name, phone', 'required'],
			['problem, date, time', 'safe'],
		);
		return $rules;
	}

	public function attributeLabels() {
		return array(
			'name' => Yii::t('admin', 'Ваше имя'),
			'phone' => Yii::t('admin', 'Контактный телефон'),
			'problem' => Yii::t('admin', 'Краткое описание Вашей проблемы'),
			'date' => Yii::t('admin', 'Желаемая дата приема'),
			'time' => Yii::t('admin', 'Время приема'),
		);
	}

}
