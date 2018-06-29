<?php
Yii::import('application.modules.invoice.models.Invoice');

class InvoiceHelper {
	
	public $userId;
	public $type; //invoice type
	public $items; //format array('name'=>, 'qty'=>, 'price'=>);
	
	public $name = '';
	public $date = '';
	public $discount = 0;
	public $shipping = 0;
	public $deposit = 0;
	public $subtotal = 0;
	
	/**
	 * Сохранение инвойса
	 * @param int $modelId // ид модели для которой создан инвойс
	 */
	public function saveInvoice($modelId = false){
		$invoice = new Invoice;
		
		if($modelId)
			$invoice = Invoice::model()->find('model_id=:model_id AND invoice_type=:type', array(':type'=>$this->type, ':model_id'=>$modelId));
		if($invoice === null || $modelId == false)
			$invoice = new Invoice;
		
		if($invoice->isNewRecord){
			$invoice->status = 0;
			if($this->date == '')
				$invoice->create_date = date(System::getDateTimeFormat());
			else 
				$invoice->create_date = $this->date;
			$invoice->due_date = '0000-00-00';
			if($invoice->invoice_type == 2)
				$invoice->tax_percent = 0;
			else
				$invoice->tax_percent = Settings::getVal('tax');
		}
		
		$invoice->invoice_type = $this->type;
		if($this->type ==0)
			$invoice->name = $this->name;
		if($modelId)
			$invoice->model_id = $modelId;
		
		//Информация о покупателе
		if($this->userId == '')
			$invoice->user_id = Yii::app()->user->id;
		else
			$invoice->user_id = $this->userId;
		$user = User::model()->findByPk($invoice->user_id);
		
		$invoice->name = $user->profile->firstname." ".$user->profile->lastname;
		$invoice->email = $user->email;
		$invoice->phone = $user->profile->mobile;
		$invoice->address = Helper::viewAddress($user->profile);
		
		//Сумма инвойсов
		$invoice->invoice_data = serialize($this->getSubtotal());
		$invoice->tax = $this->subtotal*$invoice->tax_percent*0.01;
			
		$invoice->shipping = $this->shipping;
		$invoice->deposit = $this->deposit;
		$invoice->discount = $this->discount;
		$invoice->total_cost = self::getPayment($this->subtotal, $invoice, true);
		
		if($invoice->invoice_type == 2)
			$invoice->tax = 0;
		
		if($invoice->save())
			return $invoice->id;
		else 
			return false;
			
	}
	
	//Приводим массив товаров и узнаем общую стоимость товаров
	private function getSubtotal() {
		$arr = array();
		$subtotal = 0;
		if(count($this->items)>0)
			foreach($this->items as $i => $item){
				$price = (int)$item['qty'] * (float)$item['price'];
				$subtotal += $price;
				$arr[$i] = array(1=>$item['name'], 2=> $item['qty'], 3=> $item['price'], 4=>$price);
			}
		$this->subtotal = $subtotal;
		return $arr;
	}
	
	/**
	 * Получение общей суммы платежа
	 * @param float $subtotal
	 * @param obj $model
	 * @param bool $format если true то выводим цену для записи в базу
	 * @return Ambigous <unknown, string>|number
	 */
	public static function getPayment($subtotal, $model, $format = false) {
		$payment = $subtotal + $subtotal*$model->tax_percent*0.01 + $model->shipping - $model->deposit - $model->discount;
		if($payment<0)
			$payment = 0;
		if(!$format)
			return Helper::viewPrice($payment);
		else
			return $payment;
	}
	
	public static function invoiceName($model){
		if($model->invoice_type != 0)
			$name = Yii::app()->getModule('invoice')->type[$model->invoice_type];
		else
			$name = $model->invoice_name;
		return $name;
	}
}