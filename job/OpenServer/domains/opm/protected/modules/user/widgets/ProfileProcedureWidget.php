<?php
Yii::import('application.modules.invoice.components.InvoiceHelper');
Yii::import('application.modules.invoice.models.Invoice');

class ProfileProcedureWidget extends CWidget {
	
	public $status; //to_visit || complete
	public $userId;
	
	public $avatar = '';
	
	public function run() {
		$condition = 'user_id = '.$this->userId.'';
		if($this->status == 'complete') {
			$order = 'visit_date DESC';
			$condition .= ' AND is_visit = 1';
		}
		else {
			$order = 'visit_date ASC';
			$condition .= ' AND is_visit = 0 AND visit_date > :date';
		}
		
		$dataProvider = new CActiveDataProvider('UserService', array(
			'criteria'=>array(
				'condition'=>$condition,
				'params'=>array(':date'=>date('Y-m-d')),
				'order'=>$order,
			),
			'pagination'=>array(
				'pageSize'=>3,
			),
		));
		
		$this->render('complete', array('dataProvider'=>$dataProvider));
	}
}