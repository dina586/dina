<?php
Yii::import('application.components.behavior.*');
class CartController extends Controller
{
	public $layout='//layouts/templates/store';

	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('addToCart', 'ajaxchange', 'clearcart', 'cartproddelete', 'index', 'order', 'confirm', 'cancel', 'pay'),
				'users'=>array('*'),
			),
			
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	

	
	public function actionIndex()
	{
		$this->render('index');
	}
	
	public function actionAddToCart($id)
	{
		$cart = Yii::app()->shoppingCart;
		if($id != '') {
			$product = System::loadModel('Product', $id);
			if($product !== null)
				$cart->put($product);
		}
		
		$json = array('number'=>$cart->getItemsCount(), 'total_cost'=>Helper::viewPrice($cart->getCost()));
		echo json_encode($json);
	}
	
	public function actionAjaxChange()
	{
		$id = Yii::app()->request->getParam('id');
		$number = Yii::app()->request->getParam('number');
		$product = Product::model()->findByPk($id);
		$cart = Yii::app()->shoppingCart;
		$cart->update($product, $number);
	
		$json = array('number'=>$cart->getItemsCount(), 'total_cost'=>Helper::viewPrice($cart->getCost()));
		echo json_encode($json);
	}
	
	public function actionClearCart() {
		Yii::app()->shoppingCart->clear();
		$this->redirect(array('/store/cart/index'));
	}
	
	public function actionCartProdDelete() {
		$id = Yii::app()->request->getParam('id');
		
		$product = Product::model()->findByPk($id);
		$cart = Yii::app()->shoppingCart;
		$cart->remove($product->getId());
				
		$json = array('number'=>$cart->getItemsCount(), 'total_cost'=>Helper::viewPrice($cart->getCost()));
		echo json_encode($json);
	}
	
	public function actionOrder() {
		$model = new CartForm;
		Yii::import('application.modules.helper.models.UsaStates');
		
		if(Yii::app()->user->getState('store_cart'))
			$model->attributes = Yii::app()->user->getState('store_cart');
		
		if(isset($_POST['CartForm']))
		{
			
			$model->attributes = $_POST['CartForm'];
			
			if($model->international == 1)
				$model->scenario = 'int_shipping';
			else
				$model->scenario = 'us_shipping';
			
			if($model->validate())	{
				
				User::model()->saveUser($model->attributes, 1);
				
				Yii::import('application.modules.email.models.*');
				$orderDetails = array();
				$label = $model->attributeLabels();
				
				foreach($model->attributes as $key => $value) {
					if(key_exists($key, $label) && $label[$key] != '') 
						$orderDetails[$label[$key]] = $value;
				}
				if($model->international == 1) {
					$orderDetails[$label['int_shipping']] = $model->int_shipping;
					$shipping = $model->int_shipping;
				}
				else {
					$orderDetails['US Shipping'] = $model->us_shipping;
					$shipping = $model->us_shipping;
				}
				
				unset($orderDetails[$label['comment']], $orderDetails[$label['international']], $orderDetails['us_shipping'], $orderDetails['int_shipping'],  $orderDetails['user_id']);
				$attributes = $model->attributes;
				
				$attributes['invoice_id'] = ProdHistory::saveOrder($model->email, $orderDetails, $model->comment, $shipping);
				
				if($attributes['invoice_id'] == false)
					Yii::app()->user->setFlash('cart', 'Error occupied during request. Please, try again!');
				else {
					Yii::app()->user->setState('store_cart', $attributes);
					$this->redirect(array('/store/cart/pay'));
				}
			
			}
		}
		
		$this->render('order',array('order'=>$model));
	}
	
	public function actionPay(){
		$data = StoreHelper::getPaymentData(Yii::app()->user->getState('store_cart'));
		$this->render('pay', array('data'=>$data));
	}
	
	public function actionConfirm(){
	
		if(isset($_POST)) {
			
			Yii::import('application.modules.invoice.models.*');
			Yii::import('application.modules.invoice.components.*');
			
			Invoice::model()->updateByPk($_POST['x_invoice_num'], array('status'=>1));
			$invoice = Invoice::model()->findByPk($_POST['x_invoice_num']);
			
			if($invoice !== null) {
				$model = ProdHistory::model()->findByPk($invoice->model_id);
				$model -> is_paid = 1;
				$model -> payment_system = 1;
				$model -> save();
				$history = ProdHistory::model()->findByPk(1);
				if($history !== null) {
					$message = $this->getnerateOrderTable($history);
					$orderData = unserialize($history->order_data);
					Email::sendUserNoReply($orderData['First Name'].' '.$orderData['Last Name'], $history->email, 'Site Order '.Settings::getVal('site_name'), $message);
					Email::sendAdmin(Settings::getVal('site_name'), Settings::getVal('admin_email'), 'Opm site order', $message);
				}
			}
		}
		
		$this->renderPartial('application.modules.invoice.views.invoice.confirm');
		
	}
	

	protected function getnerateOrderTable ($model) {
		$message = '';
		$orderData = unserialize($model->order_data);
			
		$message .= '<p style = "color: #000;">Name: <b>'.$orderData['First Name'].' '.$orderData['Last Name'].'</b></p>';
		$message .= '<p style = "color: #000;">Phone: '.$orderData['Phone'].'</p>';
		$message .= '<p style = "color: #000;">Email: '. $model->email.'</p>';
		if(key_exists('US Shipping', $orderData)) {
			$message .= '<p style = "color: #000;">US Shipping: $ '.$orderData['US Shipping'].'</p>';
			$ship = $orderData['US Shipping'];
		} else {
			$message .= '<p style = "color: #000;">International Purchase: $ '.$orderData['International Shipping'].'</p>';
			$ship = $orderData['International Shipping'];
		}
		
		if($model->user_comment != '') {
			$message .= '<p style = "color: #000;">Comment: '.$model->user_comment.'</p>';
		}
		
		
		$totalCost = Yii::app()->shoppingCart->getCost();
		
		$message .= '<br/>';
		
		$message .= '<table style = "border:1px dotted #989898; width:100%">';
		$message .= '<td style = "width:auto; height:auto; background-color: #EFF2F6; padding:5px;">Name</td>';
		$message .= '<td style = "background-color: #EFF2F6; padding:5px;">Number</td>';
		$message .= '<td style = "background-color: #EFF2F6; padding:5px;">Cost</td>';
		
		$total = 0;
		
		$productData = unserialize($model->prod_data);
		
		foreach($productData as $view) {
			$data = Product::model()->findByPk($view['id']);
			if($data === null) {
				$link = $view['name'];
			}else
				$link = '<a href = "'.Yii::app()->createAbsoluteUrl('store/product/view', array('url'=>$data->url)).'">'.$view['name'].'</a>';
			$message .= '<tr>';
			$message .= '<td style = "width:auto; height:auto; padding:5px; border-top:1px dotted #989898">
				'.$link.'
				</td>';
			$message .= '<td style = "width:auto; height:auto; padding:5px; border-top:1px dotted #989898; text-align:center;">'.$view['quantity'].'</td>';
			$message .= '<td style = "width:auto; height:auto; padding:5px; border-top:1px dotted #989898">'.StoreHelper::viewPrice($view['cost']).'</td>';
			$message .= '</tr>';
			$total = $total + $view['cost']*$view['quantity'];
		}
		
		$message .= '</table>';
		
		$message .= '<p style = "color: #000;">Shipping: $ '. $ship.'</p>';
		
		
		$message .= '<p><b>Total Cost:</b> $ '. $model->total_cost.'</p>';
		
		$all = $model->total_cost + $ship;
		$message .= '<p style = "color: #000;">Total Cost With Shipping : $ '. number_format($all, 2, '.', ' ').'</p>';
		
		return $message;
		
	}
	
}