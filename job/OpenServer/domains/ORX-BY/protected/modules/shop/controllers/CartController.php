<?php
Yii::import('application.extensions.phpmailer.JPhpMailer');

class CartController extends Controller
{
	public $layout= '//layouts/tmp_2columns';
	public function actionIndex()
	{
		$this->render('index');
	}
	public function actionAddToCart()
	{
		$id = Yii::app()->request->getParam('id');
		$cart = Yii::app()->shoppingCart;
		if(isset($id) && $id != '') {
			$product = Product::model()->findByPk($id);
			$cart->put($product);
		}
		$json = array('number'=>$cart->getItemsCount(), 'total_cost'=>$cart->getCost());
		echo json_encode($json);
	}
	public function actionAjaxChange()
	{
		$id = Yii::app()->request->getParam('id');
		$number = Yii::app()->request->getParam('number');
		$product = Product::model()->findByPk($id);
		Yii::app()->shoppingCart->update($product, $number);
		echo Yii::app()->shoppingCart->getCost();
	}
	public function actionClearCart() {
		Yii::app()->shoppingCart->clear();
		$this->redirect(array('/shop/cart/index'));
	}
	public function actionCartProdDelete() {
		$id = Yii::app()->request->getParam('id');
		$product = Product::model()->findByPk($id);
		Yii::app()->shoppingCart->remove($product->getId());
		echo Yii::app()->shoppingCart->getCost();
	}
	public function actionOrder() {
		$model = new CartForm;
		Yii::import('application.modules.email.models.*');
		if(isset($_POST['CartForm']))
		{
			$model->attributes=$_POST['CartForm'];
			if($model->validate())	{	
				$cart = Yii::app()->shoppingCart->getPositions();
				
				$client['name'] = $model->name;
				$client['contacts'] = $model->phone;
				$client['address'] = $model->address;
				$client['email'] = $model->email;
				
				$message = '<html><head></head><body>';
				$message .= '<p style = "color: #000;"><b>'.$model->name.'</b></p>';
				$message .= '<p style = "color: #000;">Телефон: '.$model->phone.'</p>';
				$message .= '<p style = "color: #000;">Адрес: '.$model->address.'</p>';
				$message .= '<p style = "color: #000;">email: '. $model->email.'</p>';
				if($model->body != '') {
					$message .= '<p style = "color: #000;">Комментарий: '.$model->body.'</p>';
				}
				$message .= '<p style = "color: #000;">Общая сумма: '.Yii::app()->shoppingCart->getCost().'</p>';
				$message .= '<br/>';
				$message .= '<table style = "border:1px dotted #989898">';
				$message .= '<td style = "background-color: #EFF2F6; padding:5px;">Наименование</td>';
				$message .= '<td style = "background-color: #EFF2F6; padding:5px;">Количество</td>';
				$message .= '<td style = "background-color: #EFF2F6; padding:5px;">Цена</td>';
				foreach($cart as $view) {
					$url = Yii::app()->createUrl('products/view', array('id'=>$view['id']));
					if(isset($view['share_price']) && $view['share_price'] != 0) {
							$cost = $view['share_price'];			
						}
						else {
							$cost = $view['price'];
						}
						$message .= '<tr>';
						
						$message .= '<td style = "padding:5px; border-top:1px dotted #989898">'.$view['name'].'</td>';
						$message .= '<td style = "padding:5px; border-top:1px dotted #989898; text-align:center;">'.$view->getQuantity().'</td>';
						$message .= '<td style = "padding:5px; border-top:1px dotted #989898">'.$view->getSumPrice().'</td>';
					$message .= '</tr>';
				}
				$message .= '</table>';
				$message .= '</body></html>';
				
				
				$mail = new JPhpMailer; 
				$mail->CharSet = 'UTF-8'; 
				$mail->Host       = "smtp.googlemail.com"; // SMTP server
				
				$mail->SMTPAuth   = true;                  // enable SMTP authentication
				$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
				$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
				$mail->Port       = 465;                   // set the SMTP port for the GMAIL server
				$mail->Username   = "furminatorby@gmail.com";  // GMAIL username
				$mail->Password   = "_furminator2012_";            // GMAIL password
				$mail->From = $_SERVER['SERVER_NAME'];
				$mail->FromName = 'Заказ с сайта '.$_SERVER['SERVER_NAME'];
				
				$mail->AddReplyTo($model->email, $model->name);

				$mail->Subject    = "Заказ для ".$model->name;
				$mail->MsgHTML($message);
				
				$data = Email::model()->findAll();
				foreach($data as $view) {
					$mail->AddAddress($view->email, $view->name);
				}
				
				if($mail->Send()) {
					//Добавление записей в базу
					$cart = Yii::app()->shoppingCart->getPositions();
					foreach($cart as $cartData) {
						$this->addClient($client, $cartData['id']);
					}
					$this->sendMessage($model, $message);
					Yii::app()->user->setFlash('cart','Ваш заказ отправлен! Наши менеджеры свяжутся с Вами в ближайшее время!');
					Yii::app()->shoppingCart->clear();
					$this->refresh();
				}
			}
		}
		$this->render('order',array('model'=>$model));
	}
	
	private function addClient($client, $productId) {
		Yii::import('application.modules.clients.models.*');
		$data = Clients::model()->find('email=:email', array(':email'=>$client['email']));
		if(count($data)==0) {
			$c = new Clients();
			$c -> setIsNewRecord(true);
			$c->email  = $client['email'];
			$c->address = $client['address'];
			$c->contacts  = $client['contacts'];
			$c->name  = $client['name'];
			$c->save();
		}
		$data = Clients::model()->find('email=:email', array(':email'=>$client['email']));
		$clientId = $data->id;
		
		$data = COrder::model()->find('client_id=:client_id AND product_id=:product_id', array(':client_id'=>$clientId, ':product_id'=>$productId));
		if(count($data)==0) {
			$order = new COrder();
			$order -> client_id = $clientId;
			$order -> product_id = $productId;
			$order -> save();
		}
	}
	private function sendMessage($model, $message) {
		$mail = new JPhpMailer; 
		$mail->CharSet = 'UTF-8'; 
				
		$mail->SMTPAuth   = true;                  // enable SMTP authentication
		$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
		$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
		$mail->Port       = 465;                   // set the SMTP port for the GMAIL server
		$mail->Username   = "vamskidka.by@gmail.com";  // GMAIL username
		$mail->Password   = "elizavetaelizaveta";            // GMAIL password
		$mail->From = 'vamskidka.by';
		$mail->FromName = 'Вам Скидка!';
		$mail->AddReplyTo('vamskidka.by@gmail.com');
		$mail->Subject    = "Подтверждение заказа";
		$block = Block::viewBlock(9);
		foreach($block as $view){
			$message .= $view['description'];
		}
		
		$mail->MsgHTML($message);
		
		$mail->AddAddress($model->email, $model->name);
		$mail->Send();
	}
}