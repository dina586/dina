<?php

class ProfileTypeWidget extends CWidget {
	
	public $userId;
	public $viewFilters = false;
	
	public function run() {
		$groups = UserGroup::model()->findAll(array('order'=>'position'));
		$checked = array();
		if($this->viewFilters === false)
			$checked = UserType::getUserTypes($this->userId);
		elseif(isset($_GET['UserType']))
			$checked = UserType::requestTypes($_GET['UserType']);
		$this->render('profile_user_type', array('groups'=>$groups, 'checked'=>$checked));
	}
}