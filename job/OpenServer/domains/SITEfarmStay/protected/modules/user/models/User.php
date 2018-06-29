<?php

/**
 * @author Nicholas Kobets <wemadefoxnever@gmail.com>
 * @copyright 365-solutions.com
 * @license http://365-solutions.com/general-license
 */
class User extends CActiveRecord {

	//Роль пользователя в системе
	public $user_role;
	//Переменная для подтверждения пароля
	public $confirm_password;
	//Новый пароль
	public $new_password;
	//Старый пароль
	public $old_password;

	public static function model($className = __CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return '{{users}}';
	}

	public function rules() {

		return array(
			//Общие настройки валидации
			['password, email', 'required'],
			['create_at, lastvisit_at, activkey, login, status', 'safe'],
			//Общая конфигурация параметров 
			['login', 'length', 'max' => 30, 'min' => 3, 'message' => Yii::t('admin', "Incorrect login (length between 3 and 30 characters).")],
			['password', 'length', 'max' => 128, 'min' => 4, 'message' => Yii::t('admin', "Incorrect password (minimal length 4 symbols).")],
			['email', 'email'],
			['login', 'unique', 'message' => Yii::t('admin', "This user's name already exists.")],
			['email', 'unique', 'message' => Yii::t('admin', "This user's email address already exists.")],
			['login', 'match', 'pattern' => '/^[A-Za-z0-9_]+$/u', 'message' => Yii::t('admin', "Incorrect symbols (A-z0-9).")],
			['status', 'numerical', 'integerOnly' => true],
			['email, activkey', 'length', 'max' => 128],
			//Дополнительные переменные
			['user_role', 'safe'],
			['new_password', 'length', 'max' => 128, 'min' => 4, 'message' => Yii::t('admin', "Incorrect password (minimal length 4 symbols).")],
			
			/* Сценарии */
			//Регистрация
			['confirm_password', 'required', 'on' => 'registration'],
			['confirm_password', 'compare', 'compareAttribute' => 'password', 'on' => 'registration'],
			//Восстановление пароля
			['confirm_password, new_password', 'required', 'on' => 'recovery'],
			['confirm_password', 'compare', 'compareAttribute' => 'new_password', 'on' => 'recovery'],
			//Изменение пароля пароля
			['confirm_password, new_password, old_password', 'required', 'on' => 'change_password'],
			['confirm_password', 'compare', 'compareAttribute' => 'new_password', 'on' => 'change_password'],
			['old_password', 'verifyOldPassword', 'on' => 'change_password'],
		);
	}

	/**
	 * Валадиторы
	 */
	//Проверка совпадения текущего пароля при изменении пароля
	public function verifyOldPassword($attribute) {
		if($this->{$attribute} != '' && !CPasswordHelper::verifyPassword($this->{$attribute}, $this->password))
			$this->addError($attribute, Yii::t('admin', 'Old password is incorrect'));
	}

	public function relations() {
		return array(
			'profile' => [self::HAS_ONE, 'Profile', 'user_id'],
			'r_role' => [self::HAS_ONE, 'Roles', 'user_id'],
		);
	}

	public function attributeLabels() {
		return array(
			'id' => Yii::t('admin', '№'),
			'login' => Yii::t('admin', 'Login'),
			'password' => Yii::t('admin', 'Password'),
			'email' => Yii::t('admin', 'Email'),
			'activkey' => Yii::t('admin', 'Activation Key'),
			'create_at' => Yii::t('admin', 'Create Date'),
			'lastvisit_at' => Yii::t('admin', 'Last Visit'),
			'status' => Yii::t('admin', 'Status'),
			//Переменные
			'old_password' => Yii::t('admin', 'Old Password'),
			'new_password' => Yii::t('admin', 'New Password'),
			'confirm_password' => Yii::t('admin', 'Verify Password'),
		);
	}

	public function search() {

		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('login', $this->login, true);
		$criteria->compare('email', $this->email, true);
		$criteria->compare('activkey', $this->activkey, true);
		$criteria->compare('create_at', $this->create_at, true);
		$criteria->compare('lastvisit_at', $this->lastvisit_at, true);
		$criteria->compare('status', $this->status);

		return new CActiveDataProvider(get_class($this), array(
			'pagination' => array(
				'pageSize' => Yii::app()->user->getState('pageSize', Yii::app()->params['defaultPageSize']),
			),
			'criteria' => $criteria,
		));
	}

	public function beforeSave() {
		if ($this->isNewRecord) {
			$this->create_at = date('Y-m-d H:i:s');
			if ($this->status == '')
				$this->status = 0;
			$this->password = CPasswordHelper::hashPassword($this->password);
			$this->activkey = md5(microtime() . $this->password);
		}

		//Перенегенируем новый пароль только для определенных сценариев
		if (in_array($this->scenario, array('recovery', 'change_password')))
			$this->password = CPasswordHelper::hashPassword($this->password);

		parent::beforeSave();
		return true;
	}

	/**
	 * Сохранение связанных данных для моделей User и Profile через транзакцию
	 * @param obj $model
	 * @param obj $profile
	 */
	public function saveData($model, $profile) {
		$errors = array();
		$newRecord = $model->isNewRecord;
		$transaction = Yii::app()->db->beginTransaction();

		if (!$model->save())
			$errors = array_merge($errors, $model->getErrors());

		$role = new Roles;
		if ($newRecord)
			$role->user_id = $profile->user_id = $model->id;
		else
			$role = $model->r_role;

		if ($this->user_role != '')
			$role->role_name = $this->user_role;
		if (!$role->save())
			$errors = array_merge($errors, $role->getErrors());

		if (!$profile->save())
			$errors = array_merge($errors, $profile->getErrors());

		if (empty($errors)) {
			$transaction->commit();
			return true; //Возвращаем успешное сохранение
		} else {
			$transaction->rollBack();
		}

		return $errors;
	}

}
