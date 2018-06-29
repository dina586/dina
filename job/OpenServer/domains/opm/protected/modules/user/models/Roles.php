<?php

/**
 * This is the model class for table "{{roles}}".
 *
 * The followings are the available columns in table '{{roles}}':
 * @property integer $user_id
 * @property string $role
 * @property string $operations
 */
class Roles extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Roles the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{roles}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('role', 'required'),
			array('operations', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('user_id, role, operations', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'user'=>array(self::BELONGS_TO, 'User', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'user_id' => 'id пользователя',
			'role' => 'Статус пользователя',
			'operations' => 'Роль на сайте',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('role',$this->role,true);
		$criteria->compare('operations',$this->operations,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function beforeValidate() {
    	if($this->role == '') {
    		$this->role = 'user';
    	}
    	return true;
    }
	
    public static function createOperations($roles) {
		if(count($roles)>0){
			foreach($roles as $key => $role) {
				if($role != '') {
					$names[$key] = $role;
				}
			}
			if(count($names)>0) {
				return implode(',', $names);
			} else {
				return '';
			}
		} else {
			return '';
		}
	}
}