<?php
/**
 * Yii-User module
 * 
 * @author Mikhail Mangushev <mishamx@gmail.com> 
 * @link http://yii-user.2mx.org/
 * @license http://www.opensource.org/licenses/bsd-license.php
 * @version $Id: UserModule.php 132 2011-10-30 10:45:01Z mishamx $
 */

class UserModule extends CWebModule
{
	/**
	 * @var int
	 * @desc items on page
	 */
	public $user_page_size = 10;
	
	/**
	 * @var int
	 * @desc items on page
	 */
	public $fields_page_size = 10;
	
	/**
	 * @var string
	 * @desc hash method (md5,sha1 or algo hash function http://www.php.net/manual/en/function.hash.php)
	 */
	public $hash='md5';
	
	/**
	 * @var boolean
	 * @desc use email for activation user account
	 */
	public $sendActivationMail=true;
	
	/**
	 * @var boolean
	 * @desc allow auth for is not active user
	 */
	public $loginNotActiv=false;
	
	/**
	 * @var boolean
	 * @desc activate user on registration (only $sendActivationMail = false)
	 */
	public $activeAfterRegister=false;
	
	/**
	 * @var boolean
	 * @desc login after registration (need loginNotActiv or activeAfterRegister = true)
	 */
	public $autoLogin=true;
	
	public $registrationUrl = array("/user/registration");
	public $recoveryUrl = array("/user/recovery/recovery");
	public $loginUrl = array("/user/login");
	public $logoutUrl = array("/user/logout");
	public $profileUrl = array("/user/profile");
	public $returnUrl = array("/user/profile");
	public $returnLogoutUrl = array("/user/login");
	
	
	/**
	 * @var int
	 * @desc Remember Me Time (seconds), defalt = 2592000 (30 days)
	 */
	public $rememberMeTime = 2592000; // 30 days
	
	public $fieldsMessage = '';
	
	
	/**
	 * @var array
	 * @desc Profile model relation from other models
	 */
	public $profileRelations = array();
	
	/**
	 * @var boolean
	 */
	public $captcha = array('registration'=>true);
	
	/**
	 * @var boolean
	 */
	//public $cacheEnable = false;
	public $tableUsers = '{{users}}';
	public $tableProfiles = '{{profiles}}';
	public $tableProfileFields = '{{profiles_fields}}';

    public $defaultScope = array(
    	'with'=>array('profile'),
    );
	
	static private $_user;
	static private $_users=array();
	static private $_userByName=array();
	static private $_admin;
	static private $_admins;
	
	static private $_model = null;
	/**
	 * @var array
	 * @desc Behaviors for models
	 */
	public $componentBehaviors=array();
	
	//Cellular Carriers
	public $carriers = array(1=>'T-Mobile', 2=>'Verizon', 3=>'AT&T', 4=>'Sprint', 5=>'Cricket', 6=>'Virgin', 7=>'Boost', 8=>'Metro PCS', 9=>'U.S. Cellular');
	
	//How did you hear about us
	public $hear = array(1=>'Friend', 2=>'Trade Show', 3=>'Website', 4=>'Google');
	
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'user.models.*',
			'user.components.*',
		));
	}
	
	public function getBehaviorsFor($componentName){
        if (isset($this->componentBehaviors[$componentName])) {
            return $this->componentBehaviors[$componentName];
        } else {
            return array();
        }
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}
	
	/**
	 * @param $str
	 * @param $params
	 * @param $dic
	 * @return string
	 */
	public static function t($str='',$params=array(),$dic='user') {
		if (Yii::t("UserModule", $str)==$str)
		    return Yii::t("UserModule.".$dic, $str, $params);
        else
            return Yii::t("UserModule", $str, $params);
	}
	
	/**
	 * @return hash string.
	 */
	public static function encrypting($string="") {
		$hash = Yii::app()->getModule('user')->hash;
		if ($hash=="md5")
			return md5($string);
		if ($hash=="sha1")
			return sha1($string);
		else
			return hash($hash,$string);
	}
	
	/**
	 * @param $place
	 * @return boolean 
	 */
	public static function doCaptcha($place = '') {
		if(!extension_loaded('gd'))
			return false;
		if (in_array($place, Yii::app()->getModule('user')->captcha))
			return Yii::app()->getModule('user')->captcha[$place];
		return false;
	}
	
	/**
	 * Return admin status.
	 * @return boolean
	 */
	public static function isAdmin() {
		if(Yii::app()->user->isGuest)
			return false;
		else {
			if (!isset(self::$_admin)) {
				if(self::user()->superuser)
					self::$_admin = true;
				else
					self::$_admin = false;	
			}
			return self::$_admin;
		}
	}

	/**
	 * Return safe user data.
	 * @param user id not required
	 * @return user object or false
	 */
	public static function user($id=0,$clearCache=false) {
        if (!$id&&!Yii::app()->user->isGuest)
            $id = Yii::app()->user->id;
		if ($id) {
            if (!isset(self::$_users[$id])||$clearCache)
                self::$_users[$id] = User::model()->with(array('profile'))->findbyPk($id);
			return self::$_users[$id];
        } else return false;
	}
	
	/**
	 * Return safe user data.
	 * @param user name
	 * @return user object or false
	 */
	public static function getUserByName($username) {
		if (!isset(self::$_userByName[$username])) {
			$_userByName[$username] = User::model()->findByAttributes(array('username'=>$username));
		}
		return $_userByName[$username];
	}
	
	/**
	 * Return safe user data.
	 * @param user id not required
	 * @return user object or false
	 */
	public function users() {
		return User;
	}
	
	public function getRole($id=false) {
		if(!$id)
			$id = Yii::app()->user->id;
		$userRoles = System::loadModel('Roles', $id);
        if($userRoles){
        	if(strlen($userRoles->operations)>0) {
         		$roles = implode(',', array($userRoles->role, $userRoles->operations));
        	} else {
        		$roles = $userRoles->role;
        	}
            return $roles;
        }
    }
 
    private function getModel(){
        if (!Yii::app()->user->isGuest && self::$_model === null){
            self::$_model = User::model()->findByPk(Yii::app()->user->id, array('select' => 'role, operations'));
        }
        return self::$_model;
    }
	
	
	/**
	 * Вывод аватара пользователя
	 * @param mixed $id
	 * @param boolean $enableStyles
	 * @param array $img
	 * @return string
	 */
	public function viewAvatar($id = '', $enableStyles = true, $img = array()) {
		
		if($id == '')
			$id = Yii::app()->user->id;
		if($id == Yii::app()->user->id) 
			$name = Yii::app()->user->username;
		else {
			$data = User::model()->findByPk($id);
			$name = $data->username;
		}
		if(!array_key_exists('width', $img)) 
			$img['width'] = '48px';
		if(!array_key_exists('height', $img)) 
			$img['height'] = '48px';
		
		$path = Yii::getPathOfAlias('webroot').DS.'upload'.DS.'avatars'.DS;
		
		if(!Yii::app()->user->isGuest) {
			if($enableStyles === true) {
				$style = 'style = "';
				foreach($img as $k => $v) {
					$style .= $k.":".$v."; ";
				}
				$style .= '"';
			}
			if(file_exists($path.$id.'.jpg')) {
				$img = '<img src = "/upload/avatars/'.$id.'.jpg" alt = "'.$name.'" title = "'.$name.'" '.$style.'/>';
			}
			else {
				$img = '<img src = "/images/noavatar.jpg" alt = "'.$name.'" title = "'.$name.'" '.$style.'/>';
			}
		} else {
			return '';
		}
		return $img;
	}
	
	public function registerJS() {
		Yii::app()->clientScript->registerPackage('phonemask');
		JS::add('phonemask', '$(".j-phone_field").mask("(999) 999-9999");');
	}
}
