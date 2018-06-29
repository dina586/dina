<?php

class User extends CActiveRecord
{
	const STATUS_NOACTIVE=0;
	const STATUS_ACTIVE=1;
	const STATUS_BANNED=-1;
		
	public $image;
	public $user_role;	
	public $s_phone;
	public $s_user;
	public $s_name;
	public $s_city;
	public $s_email;
	public $s_mobile;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return CActiveRecord the static model class
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
		return Yii::app()->getModule('user')->tableUsers;
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			array('username', 'length', 'max'=>20, 'min' => 3,'message' => UserModule::t("Incorrect username (length between 3 and 20 characters).")),
			array('password', 'length', 'max'=>128, 'min' => 4,'message' => UserModule::t("Incorrect password (minimal length 4 symbols).")),
			array('email', 'email'),
			array('username', 'unique', 'message' => UserModule::t("This user's name already exists.")),
			array('email', 'unique', 'message' => UserModule::t("This user's email address already exists.")),
			array('username', 'match', 'pattern' => '/^[A-Za-z0-9_]+$/u','message' => UserModule::t("Incorrect symbols (A-z0-9).")),
			array('status', 'in', 'range'=>array(self::STATUS_NOACTIVE,self::STATUS_ACTIVE,self::STATUS_BANNED)),
            array('create_at', 'default', 'value' => date('Y-m-d H:i:s'), 'setOnEmpty' => true, 'on' => 'insert'),
            array('lastvisit_at', 'default', 'value' => '0000-00-00 00:00:00', 'setOnEmpty' => true, 'on' => 'insert'),
			array('username, email, status', 'required'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('s_in_service, s_in_product, s_in_student, s_in_client, s_in_models, id, s_city, s_user, s_name, username, password, email, activkey, create_at, lastvisit_at, status, user_role s_phone', 'safe', 'on'=>'search'),
			array('s_city, s_phone, user_role, s_name, s_email, ', 'safe', 'on'=>'listSearch'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
        return array(
        	'profile' => array(self::HAS_ONE, 'Profile', 'user_id'),
        	'roles'=>array(self::HAS_ONE, 'Roles', 'user_id'),
        	'r_type'=>array(self::HAS_MANY, 'UserType', 'user_id'),
        );
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => UserModule::t("Id"),
			'username'=>UserModule::t("Username"),
			'password'=>UserModule::t("Password"),
			'verifyPassword'=>UserModule::t("Retype Password"),
			'email'=>UserModule::t("E-mail"),
			'verifyCode'=>UserModule::t("Verification Code"),
			'activkey' => UserModule::t("activation key"),
			'createtime' => UserModule::t("Registration date"),
			'create_at' => UserModule::t("Registration date"),
			'lastvisit_at' => UserModule::t("Last visit"),
			'status' => UserModule::t("Status"),
			'image' => Yii::t('main', 'Avatar'),
			's_in_service'=>'Services',
			's_in_product'=>'Products',
			's_in_student'=>'Students',
			's_in_client'=>'Potential Clients',
			's_in_models'=>'Models',
			's_city'=>'City',
			's_name'=>'Client Name',
			's_phone'=>'Phone',
			's_email'=>'Email',
		);
	}
	
	public function scopes()
    {
        return array(
            'active'=>array(
                'condition'=>'status='.self::STATUS_ACTIVE,
            ),
            'notactive'=>array(
                'condition'=>'status='.self::STATUS_NOACTIVE,
            ),
            'banned'=>array(
                'condition'=>'status='.self::STATUS_BANNED,
            ),
            'notsafe'=>array(
            	'select' => 'id, username, password, email, activkey, create_at, lastvisit_at, status',
            ),
        );
    }
	
	public function defaultScope()
    {
        return CMap::mergeArray(Yii::app()->getModule('user')->defaultScope,array(
            'alias'=>'user',
            'select' => 'user.id, user.username, user.email, user.create_at, user.lastvisit_at, user.status',
        ));
    }
	
	public static function itemAlias($type,$code=NULL) {
		$_items = array(
			'UserStatus' => array(
				self::STATUS_NOACTIVE => UserModule::t('Not active'),
				self::STATUS_ACTIVE => UserModule::t('Active'),
				self::STATUS_BANNED => UserModule::t('Banned'),
			),
			'AdminStatus' => array(
				'0' => UserModule::t('No'),
				'1' => UserModule::t('Yes'),
			),
		);
		if (isset($code))
			return isset($_items[$type][$code]) ? $_items[$type][$code] : false;
		else
			return isset($_items[$type]) ? $_items[$type] : false;
	}
	
	public function behaviors(){
		return array(
			'fileManagerBehavior' => array(
				'class'=> 'application.components.behavior.FileManagerBehavior',
			),
			'dateBehavior' =>array(
				'class' => 'application.components.behavior.DateBehavior',
				'datetime'=>array('create_at'),
			),
		);
	}
	
	/**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
	
    public function search($model)
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria=new CDbCriteria;
        $criteria->with = array('roles', 'profile');
        
        if(Yii::app()->user->role != 'developer')
			$criteria->addCondition('roles.role != "developer"');
        
        $criteria->compare('email',trim($model->s_user),true, 'OR');
        $criteria->compare('profile.mobile', trim($model->s_user),true, 'OR');
        $criteria->compare('CONCAT(profile.firstname, " ", profile.lastname)', trim($model->s_user),true, 'OR');
       
		return $criteria;

    }
    
    public function listSearch()
    {
    	// Warning: Please modify the following code to remove attributes that
    	// should not be searched.
    
    	$criteria=new CDbCriteria;
    	$criteria->with = array('roles', 'profile', 'r_type');
		$criteria->together = true;
    
    	if(Yii::app()->user->role != 'developer')
    		$criteria->addCondition('roles.role != "developer"');
    
    	$criteria->compare('id',$this->id);
    	$criteria->compare('email',$this->s_email, true);
    	$criteria->compare('CONCAT(profile.firstname, " ", profile.lastname)',$this->s_name,true);
		
		if($this->s_city != '')
			$criteria->compare('profile.city_id',$this->s_city);
		
		if($this->s_phone != '')
			$criteria->compare('profile.mobile', $this->s_phone, true);
		
		if(isset($_GET['UserType'])) {
			$criteria->addInCondition('r_type.type_id', UserType::requestTypes($_GET['UserType']));
			
			$criteria->group = 'r_type.user_id';
		}
    		
    	return new CActiveDataProvider(get_class($this), array(
    		'criteria'=>$criteria,
    		'sort'=>array(
    			'defaultOrder'=>'create_at DESC',
    			'attributes'=>array(
    				'user_role'=>array(
    					'asc'=>'roles.role',
    					'desc'=>'roles.role DESC',
    				),
       				's_name'=>array(
    					'asc'=>'CONCAT(profile.firstname, " ", profile.lastname)',
    					'desc'=>'CONCAT(profile.firstname, " ", profile.lastname) DESC',
    					),
    				'*',
    			),
    		),
    		'pagination'=>array(
    			'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
    		),
    	));
    }
    

    public function getCreatetime() {
        return strtotime($this->create_at);
    }

    public function setCreatetime($value) {
        $this->create_at=date('Y-m-d H:i:s',$value);
    }

    public function getLastvisit() {
        return strtotime($this->lastvisit_at);
    }

    public function setLastvisit($value) {
        $this->lastvisit_at=date('Y-m-d H:i:s',$value);
    }

    //Список ролей для грида в админке
	public function adminSearchRoles($userRole = '') {
		$roles = BsHtml::listData(Yii::app()->authManager->getRoles(), 'name', 'description');
		if(Yii::app()->user->role != 'developer')
			unset($roles['developer']);
		
		if($userRole != '')
			return BsHtml::dropDownList("user_role", $userRole, $roles, array("class"=>"j-user_role"));
		else
			return $roles;
	}
	
	public function beforeValidate() {
		if($this->isNewRecord && Yii::app()->controller->id == 'admin') {
			$this->password= Yii::app()->controller->module->encrypting($this->email);
			//$this->username= Translit::asURLSegment($this->email);
			$this->status = 1;
		}
		if($this->username == '')
			$this->username = date('Ymdhhis');
		parent::beforeValidate();
		return true;
	}

	
	protected function beforeSave() {
		
		
		parent::beforeSave();
		return true;
	}
	
	public function afterSave() {
		$transaction = Yii::app()->db->beginTransaction();
		
		try {
			if($this->isNewRecord)
				$this->setUserRoles($this->id);
		
			if(isset($_POST['UserType']) && count ($_POST['UserType'])>0) {
				$this->saveUserTypes($_POST['UserType'], $this->id);
			}
			$transaction->commit();
		}
		catch(Exception $e) {
			$transaction->rollback();
			return false;
		}
		
		parent::afterSave();
		return true;
	}
	
	public function afterDelete() {
		$model = System::loadModel('Roles', null,$this->id, 'user_id');
		$model->delete();
		UserType::model()->deleteAll('user_id=:user_id', array(':user_id'=>$this->id));
		
		parent::afterDelete();
		return true;
	}
	
	private function setUserRoles($id){
		
		$roles = new Roles;
		$roles -> isNewRecord = true;
		$roles->user_id = $id;
		$roles->role = 'user';
		$roles->operations = '';
		$roles->save();
	}
	public static function getUserCount(){
		return User::model()->with('roles')->count('roles.role !=:role', array(':role'=>'developer'));
	}
	
	public function saveUser($data, $userTypes = false) {
		$model = User::model()->find('email=:email', array(':email'=>$data['email']));
		
		if($model === null) {
			$model = new User;
			$model->username = date('Ymdhhis');
			$model->email = $data['email'];
			$model->password = UserModule::encrypting($model->username);
			$model->status = 1;
			$model->activkey = UserModule::encrypting(microtime().$model->password);
			$model->create_at = date("Y-m-d H:i:s");
			$model->save();
			
			$profile=new Profile;
			$profile->regMode = true;
			$profile->user_id = $model->id;
			
			$profile->firstname = key_exists('firstname', $data)?$data['firstname']:'';
			$profile->lastname = key_exists('lastname', $data)?$data['lastname']:'';
			$profile->mobile = key_exists('phone', $data)?$data['phone']:'';
			$profile->lastname = key_exists('lastname', $data)?$data['lastname']:'';
			$profile->zip = key_exists('zip', $data)?$data['zip']:'';
			
			$profile->save(false);

		} 
		
		if($userTypes !== false) {
			if(!is_array($userTypes))
				$userTypes = array($userTypes);
			
			$this->regUserType($userTypes, $model->id);
		}
		
		return $model->id;
	}
	
	/**
	 * Сохраняем типы пользователя
	 * @param array $userTypes
	 * @param int $userId
	 */
	protected function saveUserTypes($userTypes, $userId){
		$currentTypes = UserType::getUserTypes($userId);
		
		$newTypes = array();
		foreach($userTypes as $typeId => $v) {
			if($v != 1)
				continue;
				$newTypes[$typeId] = $typeId;
		}
		
		$arrayDiff = array_intersect($currentTypes, $newTypes);
		$toDelete = array_diff($currentTypes, $arrayDiff);
		$toInsert = array_diff($newTypes, $arrayDiff);

		//Удаляем текущие значения
		$criteria = new CDbCriteria();
		$criteria->addInCondition("type_id", $toDelete);
		$criteria->compare('user_id', $userId);
		
		UserType::model()->deleteAll($criteria);
		
		//Добавляем новые
		if(count($toInsert) >0) {
			foreach($toInsert as $typeId) {
				$model = new UserType;
				$model->type_id = $typeId;
				$model->user_id = $userId;
				$model->save();
			}
		}
	}
	
	protected function regUserType ($userTypes, $userId) {
		//Добавляем новые
		if(count($userTypes) >0) {
			foreach($userTypes as $typeId) {
				$model =  UserType::model()->find('user_id=:user_id AND type_id=:type_id', array(':type_id'=>$typeId, ':user_id'=>$userId));
				if($model!== null)
					continue;

				$model = new UserType;
				$model->type_id = $typeId;
				$model->user_id = $userId;
				$model->save();
			}
		}
	}

	
}