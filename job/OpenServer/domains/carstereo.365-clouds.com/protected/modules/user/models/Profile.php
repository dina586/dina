<?php

/**
 * @author Nicholas Kobets <wemadefoxnever@gmail.com>
 * @copyright 365-solutions.com
 * @license http://365-solutions.com/general-license
 */
class Profile extends CActiveRecord {

	public static function model($className = __CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return '{{profiles}}';
	}

	public function rules() {

		return array(
			['lastname, firstname', 'required'],
			['phone, avatar_img', 'safe'],
			['phone', 'length', 'max' => 30, 'min' => 3, 'message' => Yii::t('admin', "erererere (length between 3 and 30 characters).")],
			['lastname, firstname', 'length', 'max' => 50],
			['phone', 'length', 'max' => 100],
			//Сценарии
			//['lastname, firstname', 'required', 'on' => 'registration'],
		);
	}

	public function relations() {
		return array(
			'user' => [self::HAS_ONE, 'User', 'user_id'],
		);
	}

	public function attributeLabels() {
		return array(
			'user_id' => Yii::t('admin', '№'),
			'lastname' => Yii::t('admin', 'Lastname'),
			'firstname' => Yii::t('admin', 'Firstname'),
			'phone' => Yii::t('admin', 'Phone'),
		);
	}

	public function search() {

		$criteria = new CDbCriteria;

		$criteria->compare('user_id', $this->user_id);
		$criteria->compare('lastname', $this->lastname, true);
		$criteria->compare('firstname', $this->firstname, true);
		$criteria->compare('phone', $this->phone, true);

		return new CActiveDataProvider(get_class($this), array(
			'pagination' => array(
				'pageSize' => Yii::app()->user->getState('pageSize', Yii::app()->params['defaultPageSize']),
			),
			'criteria' => $criteria,
		));
	}
}
