<?php
/**
 * @author Nicholas Kobets <wemadefoxnever@gmail.com>
 * @copyright 365-solutions.com
 * @license http://365-solutions.com/general-license
 */
class Roles extends CActiveRecord {

	public static function model($className = __CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return '{{roles}}';
	}

	public function rules() {
		return array(
			['role_name', 'required'],
			['user_id', 'required'],
			['operations', 'length', 'max' => 255],
		);
	}

	public function relations() {
		return array(
			'user' => [self::BELONGS_TO, 'User', 'user_id'],
		);
	}

	public function attributeLabels() {
		return array(
			'user_id' => 'id',
			'role_name' => 'Роль пользователя',
			'operations' => 'Дополнительные операции для роли',
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('user_id', $this->user_id);
		$criteria->compare('role_name', $this->role_name, true);
		$criteria->compare('operations', $this->operations, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}

	public function beforeValidate() {
		if ($this->role_name == '') {
			$this->role_name = 'user';
		}
		parent::beforeValidate();
		return true;
	}

}
