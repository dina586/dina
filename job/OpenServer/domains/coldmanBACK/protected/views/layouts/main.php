<!DOCTYPE html>
<html lang="<?=Yii::app()->language; ?>">
	<head>
		<meta charset="utf-8" />
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<meta name="HandheldFriendly" content="true" />
		<meta name="apple-touch-fullscreen" content="yes" />

		<link rel="icon" type="image/vnd.microsoft.icon" href="/images/favicon.ico">
        <link rel="SHORTCUT ICON" href="/images/favicon.ico">

		<link href='http://fonts.googleapis.com/css?family=Lato:300,400,700' rel='stylesheet' type='text/css'>

		<!-- CSS for IE -->
		<!--[if lte IE 9]>
			<link rel="stylesheet" type="text/css" href="/packages/travello/css/ie.css" />
		<![endif]-->

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		  <script type='text/javascript' src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		  <script type='text/javascript' src="http://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.js"></script>
		<![endif]-->

		<?=SeoHelper::getInstance()->renderMetaTags() ?>

	</head>

    <body>
		<?php
		/* if(Yii::app()->user->checkAccess('admin'))
		  $this->renderPartial('//layouts/parts/_admin_menu');
		 */
		?>

		<div id="page-wrapper">
                    <div class="container">
			<header id="header" class="navbar-static-top">
				<div class="topnav hidden-xs">
					<div class="container">
						<ul class="quick-menu pull-left hmail">
							<li><a href="mailto:info@PatriotSoft.ru">info@PatriotSoft.ru</a></li>
						</ul>
						<div class="hlogreg">
							<div class="call_now">	
								<p><img src="../images/phone.png" alt="tel." /> ЗВОНИТЕ СЕЙЧАС  (499) 665-7796</p>
							</div>
							<div class="entlog">
								<ul class="quick-menu pull-right hreg ">
									<li class="flog"><a class="soap-popupbox login " href="#travelo-login">ВХОД</a></li>
									<li class="freg"><a class="soap-popupbox registration" href="#travelo-signup">КОНТАКТЫ</a></li>
									<div class="clearfix"></div>
								</ul>
							</div>	
							<div class="clearfix"></div>
						</div>	
						<div class="clearfix"></div>
					</div>
				</div>
				<div class="clearfix"></div>
				<div class="main-header">
					<a href="#mobile-menu-01" data-toggle="collapse" class="mobile-menu-toggle">
						Mobile Menu Toggle
					</a>

					<div class="container">
						<div class="logo navbar-brand j-logo_chaser">
							<a class="hlogo" href="#"><span class="logo_color_red">Патриот</span> <span class="logo_colour_blue">Софт</span></a>
								<a><span class="logo_hide">Разработка решений для автоматизации бизнеса</span></a>
							

						</div>

						<nav id="main-menu" role="navigation">
							<?php
							$this->renderPartial('application.views.layouts.parts._top_menu', ['id' => '']);
							?>
						</nav>
					</div>
				</div>


				<nav id="mobile-menu-01" class="mobile-menu collapse">
					<?php
					$this->renderPartial('application.views.layouts.parts._top_menu', ['id' => 'mobile-primary-menu']);
					?>
				</nav>
                                


			</header>
                    </div>  
			
			<div id ="page-wrapper">
				<?=$content; ?>
			</div>



			<footer id="footer">
				
					<div class="gcolor">
						
                                                    
                                            <div class="container">
						<div class="fleft down">
							<a class="hlogo" href="#"><span class="logo_color_red">Патриот</span> <span class="logo_colour_blue">Софт</span></a>
                                                        <a href="#" class="flogo"><span class=" logo_hide ">Разработка решений для автоматизации бизнеса</span></a>
						</div>
						<div class="formcontact">
                                                        <ul class="">
                                                            <li class="bluecolor"><a  href="#travelo-login">Форма заказа</a></li>
                                                            <li class="orangecolor"><a  href="#travelo-signup">Контакты</a></li>

							</ul>
						</div>
                                             </div> 
                                             <div class="clearfix"></div>
                                             <div class="container">
                                                <div class="fleft fleft_l">
                                                    <ul>
                                                        <li><a>CRM системы</a></li>
							<li><a>Социальные сети</a></li>
							<li><a>Программы для Документооборота</a></li>
							<li><a>Программы для Склада и учета</a></li>
							<li><a>Программы для Транспортных предприятий</a></li>
							<li><a>Программы для Полиграфический предприятий</a></li>
							<li><a>Онлайн формы</a></li>
							<li><a>Онлайн интерактивные анкеты</a></li>
							<li><a>Онлайн календари</a></li>
							<li><a>Онлайн калькуляторы</a></li>
                                                        <li><a>Онлайн заказ товаров</a></li>
							<li><a>Онлайн заказ печати визиток, календарей листовок, маек</a></li>
                                                        <li><a>Онлайн выставление счетов</a></li>
							<li><a>Онлайн порталы, сайты и магазины</a></li>
                                                    </ul>
						</div>
						<div class="frigth">
                                                    <div class="fsl"><a href="mailto:info@PatriotSoft.ru">info@PatriotSoft.ru</a></div>
							<div class="frigthimgone">
                                                            <img  class="absoluteimgone" src="../images/phone.png" alt="tel." />
                                                            <p class="rigthfloat">Звоните нам Минск +375 29 677-7777</p>
                                                            <img  class="absoluteimg" src="../images/phone.png" alt="tel." />
                                                            <div class="clearfix"></div>
                                                            <p>Москва   +7 499 665-7796</p>
							</div>
							<div class="icons">
									<a href="#"><img src="../images/facebook.png" alt="tel." /></a>
									<a href="#"><img src="../images/vk.png" alt="tel." /></a>
									<a href="#"><img src="../images/youtube.png" alt="tel." /></a>
							</div>
								<p>Все права защищены @ 2015 <a href="#">PatriotSoft.ru</a></p>
								<a href="#">Сайт разработан в группе Патриот Софт</a>

						</div>
                                            </div>     
                                            <div class="clearfix"></div>
                            
                                                     
                                                
                                             
						
                                        </div>	
				
			</footer>
                    </div>

			<?php
			$cs = Yii::app()->clientScript;
			$cs->registerCoreScript('jquery');
			$cs->registerCoreScript('jquery.ui');
			$cs->registerPackage('bootstrap');
			$cs->registerPackage('travello');
			$cs->registerScriptFile('http://html5shiv.googlecode.com/svn/trunk/html5.js', CClientScript::POS_END, array('media' => 'lt IE 9'));
			$cs->registerScriptFile(Yii::app()->baseUrl.'/js/system.jquery.js');
			$cs->registerScriptFile(Yii::app()->baseUrl.'/js/main.jquery.js');
			$cs->registerScriptFile(Yii::app()->baseUrl.'/js/waypoints.min.js');
			$cs->registerCssFile(Yii::app()->baseUrl.'/css/main.css');
			?>

    </body>
</html>

