<?php

class WebUser extends CWebUser
{

	private $_model = null;
	
	public function getRole($id = null) {
		return Yii::app()->getModule('user')->getRole($id);
	}
	
	public function avatar($id = '', $enableStyles = true, $img = array()) {
		return Yii::app()->getModule('user')->viewAvatar($id, $enableStyles, $img);
	}
	
    public function getId()
    {
        return $this->getState('__id') ? $this->getState('__id') : 0;
    }

    protected function afterLogin($fromCookie)
	{
        parent::afterLogin($fromCookie);
        $this->updateSession();
	}

    public function updateSession() {
        $user = Yii::app()->getModule('user')->user($this->id);
        
        $userAttributes = CMap::mergeArray(array(
                                                'email'=>$user->email,
                                                'username'=>$user->username,
                                                'create_at'=>$user->create_at,
                                                'lastvisit_at'=>$user->lastvisit_at,
                                           ),$user->profile->getAttributes());
        foreach ($userAttributes as $attrName=>$attrValue) {
            $this->setState($attrName,$attrValue);
        }

        $this->setState('role', $this->getRole($this->id));
    }

    public function model($id=0) {
        return Yii::app()->getModule('user')->user($id);
    }

    public function user($id=0) {
    	
       return $this->model($id);
    }

    public function getUserByName($username) {
        return Yii::app()->getModule('user')->getUserByName($username);
    }

}