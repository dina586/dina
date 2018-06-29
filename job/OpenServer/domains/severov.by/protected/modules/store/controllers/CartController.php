<?php
Yii::import('application.components.behavior.*');
class CartController extends Controller
{
	public $layout='//layouts/templates/base';

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
				'actions'=>array('addToCart', 'ajaxchange', 'clearcart', 'cartproddelete', 'index', 'order', 'confirm', 'cancel'),
				'users'=>array('*'),
			),
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('order'),
				'users'=>array('@'),
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
		
		$json = array('number'=>$cart->getItemsCount(), 'total_cost'=>number_format($cart->getCost(), 0, '', ' '));
		echo json_encode($json);
	}
	
	public function actionAjaxChange()
	{
		$id = Yii::app()->request->getParam('id');
		$number = Yii::app()->request->getParam('number');
		$product = Product::model()->findByPk($id);
		$cart = Yii::app()->shoppingCart;
		$cart->update($product, $number);
	
		$json = array('number'=>$cart->getItemsCount(), 'total_cost'=>$cart->getCost());
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
				
		$json = array('number'=>$cart->getItemsCount(), 'total_cost'=>$cart->getCost());
		echo json_encode($json);
	}
	
	public function actionOrder() {
		$model = new CartForm;
		$priv = new PrivForm;
		
		if(Yii::app()->user->getState('cart_model'))
			$priv = Yii::app()->user->getState('priv_model');
		
		Yii::import('application.modules.email.models.*');
		
		if(isset($_POST['CartForm']) || isset($_POST['PrivForm']))
		{
			if(isset($_POST['CartForm'])) {
				$base = $model;
				$base->attributes = $model->attributes = $_POST['CartForm'];
			} else {
				$base = $priv;
				$base->attributes = $priv->attributes = $_POST['PrivForm'];
			}
			if($base->validate())	{
			
				$orderDetails = array();
				$label = $base->attributeLabels();
				$message = '';
				foreach($base->attributes as $key => $value) {
					if($label[$key] != '') 
						$orderDetails[$label[$key]] = $value;
					$message .= '<p><b>'.$label[$key].':</b> '.$value.'</p>';
				}
				
				unset($orderDetails['comment'], $orderDetails['email']);
				
				ProdHistory::saveOrder($base->email, $orderDetails, $base->comment);
				
				$message = $this->getnerateOrderTable($message);
				Email::sendUserNoReply($base->name, $base->email, 'Заказ с сайта '.Settings::getVal('site_name'), $message);
				$email = Email::sendAdmin(Settings::getVal('site_name'), Settings::getVal('admin_email'), 'Заказ с сайта', $message);
				
				Yii::app()->shoppingCart->clear();
				Yii::app()->user->setFlash('cart', 'Ваш заказ успешно отправлен! Мы свяжемся с Вами в ближайшее время!');
				$this->refresh();
			}
		}
		
		$this->render('order',array('order'=>$model, 'priv'=>$priv));
	}
	
	
	protected function getnerateOrderTable ($message) {
		$cart = Yii::app()->shoppingCart->getPositions();
		
		$message .= '<p><b>Общая сумма:</b> '. number_format(Yii::app()->shoppingCart->getCost(), 0, '', ' ').'</p>';
		
		$message .= '<br/>';
		
		$message .= '<table style = "border:1px dotted #989898; width:100%">';
		$message .= '<td style = "width:auto; height:auto; background-color: #EFF2F6; padding:5px;">Наименование</td>';
		$message .= '<td style = "background-color: #EFF2F6; padding:5px;">Артикул</td>';
		$message .= '<td style = "background-color: #EFF2F6; padding:5px;">Кол-во</td>';
		$message .= '<td style = "background-color: #EFF2F6; padding:5px;">Цена за единицу</td>';
		
		
		foreach($cart as $view) {
			$message .= '<tr>';
			$message .= '<td style = "width:auto; height:auto; padding:5px; border-top:1px dotted #989898">
				<a href = "'.Yii::app()->createAbsoluteUrl('store/product/view', array('url'=>$view['url'])).'">'.$view['name'].'</a>
				</td>';
			$message .= '<td style = "width:auto; height:auto; padding:5px; border-top:1px dotted #989898; text-align:center;">'.$view['articul'].'</td>';
			$message .= '<td style = "width:auto; height:auto; padding:5px; border-top:1px dotted #989898; text-align:center;">'.$view->getQuantity().'</td>';
			$message .= '<td style = "width:auto; height:auto; padding:5px; border-top:1px dotted #989898">'.number_format($view->getSumPrice(), 0, '', ' ').'</td>';
			$message .= '</tr>';
		}
		
		$message .= '</table>';
		
		return $message;
			
	}
	
}