<?php
Yii::import('application.modules.invoice.components.InvoiceHelper');
Yii::import('application.modules.invoice.models.Invoice');

class InvoiceBehavior extends CActiveRecordBehavior {
	
	public $type;
	
	/* Поля связки для забора данных для инвойса
	 * array(
	 * 		'itemName'=>$fieldname, 
	 * 		'itemQty'=>$fieldName or $number, 
	 * 		'itemPrice'=>$fieldName, 
	 * 		'connect'=>$relationname, use for get item name
	 * )
	 */
	
	public $itemFields = array(); 
	
	public function afterValidate($event){
		if($this->type == '')
			$this->owner->addError('invoice_type', 'You must choose invoice type.');
		if(!isset($this->owner->user_id))
			$this->owner->addError('user', 'User ID required.');
	}
	
	public function afterSave($event) {
		$invoice = new InvoiceHelper;
		
		if($this->checkInvoice($this->owner->id)) {
			
			$invoice->userId = $this->owner->user_id;
			$invoice->type = $this->type;
			
			if(key_exists('connect', $this->itemFields))
				$itemName = $this->owner->{$this->itemFields['connect']}->{$this->itemFields['itemName']};
			else
				$itemName = $this->owner->{$this->itemFields['itemName']};
				
			if(is_string($this->itemFields['itemQty']))
				$qty = $this->owner->{$this->itemFields['itemQty']};
			else
				$qty = $this->itemFields['itemQty'];
			
			$invoice -> items = array(array('name'=>$itemName, 'qty'=>$qty, 'price'=>$this->owner->{$this->itemFields['itemPrice']}));
			
			$invoice->saveInvoice($this->owner->id);
		}
	}
	
	public function afterDelete($event){
		if($this->checkInvoice($this->owner->id)) {
			$invoice = Invoice::model()->find('model_id=:model_id AND invoice_type=:type', array(':type'=>$this->type, ':model_id'=>$this->owner->id));
			$invoice->delete();
		}
	}
	
	/**
	 * Проверяем инвойс на оплату. Оплаченные инвойсы не меняются
	 * @param int $modelId
	 * @return boolean
	 */
	protected function checkInvoice($modelId){
		$model = Invoice::model()->find('model_id=:model_id AND invoice_type=:type AND status = 1', array(':type'=>$this->type, ':model_id'=>$modelId));
		if($model === null)
			return true;
		else 
			return false;
	}

}