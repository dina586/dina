<?php
class AuthManager extends CPhpAuthManager{
    public function init(){
        // Иерархию ролей расположим в файле auth.php в директории config приложения
        if($this->authFile===null){
            $this->authFile=Yii::getPathOfAlias('application.config.auth').'.php';
        }
 
        parent::init();

        // Для гостей у нас и так роль по умолчанию guest.
        if(!Yii::app()->user->isGuest){
            // Связываем роль, заданную в БД с идентификатором пользователя,
            // возвращаемым UserIdentity.getId().
			$roles = explode(',', Yii::app()->user->getRole());
			foreach($roles as $role) {
				$this->assign(trim($role), Yii::app()->user->id);
			}
		}
	}
	
	public function adminRoles() {
		return array('admin', 'developer');
	}
}