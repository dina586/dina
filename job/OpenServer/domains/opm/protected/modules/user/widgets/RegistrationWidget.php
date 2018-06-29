<?php
class RegistrationWidget extends CWidget {
	
	public function run() {
		$model = new QuickRegistration();
		if(isset($_POST['QuickRegistration']))
		{
			$model->attributes = $_POST['QuickRegistration'];
			if($model->validate()){
				
			}
		}
		
		$this->render('registration', array('model'=>$model));		
	}
	
}