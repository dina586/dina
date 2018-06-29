<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="ru">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=965" />
		<meta http-equiv="Content-Type" content="text/html; Charset=UTF-8">
		<link rel="stylesheet" type="text/css" href="css/main.css" />
			
		<title>form</title>
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<script src="http://code.jquery.com/jquery-1.11.1.min.js" type="text/javascript"></script>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script>
		<script type="text/javascript" src="js/jquery.form.js" ></script>
		<script type="text/javascript" src="js/jquery.validate.js" ></script>
		<script type="text/javascript" src="js/main.jquery.js" ></script>
	</head>
	<body>
<?php ?>
		<form method="POST"   class="g-form" id="g-form">
			
		<div id="a-request_form">
			<input TYPE="text"  class="g-form_name " name="name"  placeholder="ФИО" /><br/>
			 
			<input TYPE="text"  class="g-form_email" name="email"  placeholder="email" /><br/>
			
			<input TYPE="text"  class="g-form_phone" name="phone"  placeholder="телефон"/><br/>
			
			<select name='city-from' class="g-form_select">
				<option value='0'>точка отправления</option>
				<option value='brest'>Брест</option>
				<option value='vitebsk'>Витебск</option>
				<option value='gomel'>Гомель</option>
				<option value='grodno'>Гродно</option>
				<option value='minsk'>Минск</option>
				<option value='mogilev'>Могилев</option>
			</select> <br/>
			<select name='city-to' class="g-form_select" >
				<option value='0'>точка прибытия</option>
				<option value='brest'>Брест</option>
				<option value='vitebsk'>Витебск</option>
				<option value='gomel'>Гомель</option>
				<option value='grodno'>Гродно</option>
				<option value='minsk'>Минск</option>
				<option value='mogilev'>Могилев</option>
			</select><br/>
			<button type="submit" name="send" class="g-form_send" value="send">                                   
				<span>УЗНАТЬ</span>
			</button> 
		</div>
		<?php $tarify = array(
				0 => array("from" => "brest", "to" => "vitebsk", "price" => "400"),
				1 => array("from" => "brest", "to" => "gomel", "price" => "900"),
				2 => array("from" => "brest", "to" => "grodno", "price" => "200"),
				3 => array("from" => "brest", "to" => "minsk", "price" => "300"),
				4 => array("from" => "brest", "to" => "mogilev", "price" => "500"),
				5 => array("from" => "vitebsk", "to" => "gomel", "price" => "200"),
				6 => array("from" => "vitebsk", "to" => "grodno", "price" => "300"),
				7 => array("from" => "vitebsk", "to" => "minsk", "price" => "350"),
				8 => array("from" => "vitebsk", "to" => "mogilev", "price" => "150"),
				9 => array("from" => "grodno", "to" => "gomel", "price" => "1000"),
				10 => array("from" => "grodno", "to" => "minsk", "price" => "250"),
				11 => array("from" => "grodno", "to" => "mogilev", "price" => "650"),		
				12 => array("from" => "gomel", "to" => "minsk", "price" => "400"),
				13 => array("from" => "gomel", "to" => "mogilev", "price" => "180"),
				14 => array("from" => "mogilev", "to" => "minsk", "price" => "280"),		
			);
		?>
		
		 	
			
			<?php  
			ini_set('display_errors',1);
			error_reporting(E_ALL);
			
			if (isset($_POST['send'])){
				
				/*if(trim($_POST['name']) == '') {
					echo '<div class="error_name">Пожалуйста, введите ваше имя.</div><br/>';
				} 
				else {
					$name = trim($_POST['name']);
				}
				
				
				
				if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
					$email = trim($_POST['email']);
				}
				else {
					echo '<div class="error_name">Пожалуйста, введите корректный email.</div><br/>';
				}*/
			}
			
			/*
			
			
			
			$cityFrom = isset($_POST['city-from'])?$_POST['city-from']:'укажите пункт отправления';
			$cityTo = isset($_POST['city-to'])?$_POST['city-to']:'укажите пункт прибытия';
			//$cityPrice = '';
			
			$count = count($tarify);
			
			if ($cityFrom !== $cityTo){
				for ($i = 0; $i < $count; $i++){
					echo '<div id="a-response_form">Стоимость доставки из пункта &nbsp;' .$cityFrom. '&nbsp;в пункт&nbsp;' .$cityTo. ':' .$tarify[$i]["price"].'</div>';
				}
			}
			else echo 'вы указали один и тот же  пункт отправления и прибытия<br/>';	*/	
				
				
			?>
		 
					
		
	</form>
	
	</body>
</html>