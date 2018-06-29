<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public $layout='//layouts/tmp_2columns';
	
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		Yii::import('application.modules.content.models.*');
		Yii::app()->clientScript->registerScriptFile(
		    Yii::app()->assetManager->publish(
		        Yii::getPathOfAlias('application.modules.shop.assets.js').'/shop.js'
		    ),
		   	CClientScript::POS_HEAD
		);
		$dataProvider=Product::sliderData();
		$content = Content::model()->findByPk(4);
		$this->render('index', array(
			'dataProvider'=> $dataProvider,
			'model'=>$content,
		));
	}
	public function actionClear()
	{
		$dir = Yii::getPathOfAlias('webroot').DS.'upload'.DS.'temp'.DS;
		Yii::app()->cFile->set($dir)->delete();
		Yii::app()->cFile->createDir(0775, $dir);
		Yii::app()->cFile->set($dir, true)->setPermissions('0777');
	}
	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}

	/**
	 * Displays the contact page
	 */
		public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				Yii::import('application.modules.email.models.*');
				Yii::import('application.extensions.phpmailer.JPhpMailer');
				
				$mail = new JPhpMailer; 
				$mail->IsSMTP(); // telling the class to use SMTP
				$mail->CharSet = 'UTF-8'; 
				$mail->Host       = "smtp.googlemail.com"; // SMTP server
				
				$mail->SMTPAuth   = true;                  // enable SMTP authentication
				$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
				$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
				$mail->Port       = 465;                   // set the SMTP port for the GMAIL server
				$mail->Username   = "furminatorby@gmail.com";  // GMAIL username
				$mail->Password   = "_furminator2012_";            // GMAIL password
				$mail->From = $_SERVER['SERVER_NAME'];
				$mail->FromName = 'Сообщение с сайта '.$_SERVER['SERVER_NAME'];
				
				$mail->AddReplyTo($model->email, $model->name);

				$mail->Subject    = "Сообщение с сайта ' ".$model->name;
				$mail->MsgHTML($model->body);
				
				$data = Email::model()->findAll();
				foreach($data as $view) {
					$mail->AddAddress($view->email, $view->name);
				}
				if($mail->Send()) {
					//Добавление записей в базу
					Yii::app()->user->setFlash('contact','Ваше сообщение отправлено! Наши менеджеры свяжутся с Вами в ближайшее время!');
					Yii::app()->shoppingCart->clear();
					$this->refresh();
				}
			}
		}
		$this->render('contact',array('model'=>$model));
	}


	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
	public function sliderView($data, $field) {
		$view = '';
		if(count($data)>0) {
			foreach($data as $value) {
				if($value[$field] == 1){
				$url = Yii::app()->createUrl('/shop/product/view', array('url'=>$value['url']));
				if(isset($value['share_price']) && $value['share_price'] != 0) {
					$cost = $value['share_price'];	
					$price = '
						<div class = "b-price b-share_price">
							<p><b>Старая цена: </b><span class = "k-price">'.$value['price'].'</span></p>
						</div>
						<div class = "b-price">
							<p><b>Цена: </b><span class = "k-share_price">'.$value['share_price'].'</span></p>
						</div>
						';
				}
				else {
					$cost = $value['price'];
					$price = '
						<div class = "b-price">
							<p><b>Цена: </b><span class = "k-share_price">'.$value['price'].'</span></p>
						</div>
						';
				}
				if(is_file(ROOT_PATH.DIRECTORY_SEPARATOR.'upload'.DIRECTORY_SEPARATOR.'product'.DIRECTORY_SEPARATOR.$value['product_id'].DIRECTORY_SEPARATOR.'thumbnails'.DIRECTORY_SEPARATOR.$value['front_image'])){
					$img = '<img src = "/upload/product/'.$value['product_id'].'/thumbnails/'.$value['front_image'].'"/>';
				}
				else {
					$img = '<img src = "/images/no-img.png"/>';
				}
				$view .= '
					<li>
						<div class = "b-product_view b-add_to_cart">
							<a class = "slider_img_cont" href = "'.$url.'">'.$img .'</a>
							<a href = "'.$url.'" class = "slider_link">
								'.$value['name'].'
							</a>
							<section class = "j-product_preview_descr">
								'.$value['description'].'
							</section>
							<div class = "b-price_wrap j-price_wrap">'.$price.'</div>
							<input type = "hidden" name = "k-prod_id" value = "'.$value['product_id'].'" />
							<input type = "hidden" name = "k-prod_cost" value = "'.$cost.'" />
							<a class = "add_to_cart_button j-add_to_cart" href = "#">купить</a>
						</div>
					</li>';
				}
			}
		}
		
		return $view;
	}
}