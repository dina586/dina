<!DOCTYPE html>
<html lang="<?=Yii::app()->language;?>">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=1168" />
	<link rel="icon" type="image/vnd.microsoft.icon" href="/images/favicon.ico" />
	<link rel="SHORTCUT ICON" href="/images/favicon.ico" />
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,400,700" />
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700" />
    <link href="http://fonts.googleapis.com/css?family=Roboto:400,300,300italic,100,400italic,700,500,900" rel="stylesheet" type="text/css" />
    <link href="http://fonts.googleapis.com/css?family=Nothing+You+Could+Do" rel="stylesheet" type="text/css" /> 
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

	
	<?php Yii::app()->getClientScript()->registerCoreScript('jquery');
	$cs=Yii::app()->clientScript;
	$cs->registerPackage('colorbox');
	$cs->registerScriptFile(Yii::app()->baseUrl . '/js/jquery-migrate-1.2.1.min.js');  
	$cs->registerScriptFile(Yii::app()->baseUrl . '/js/jquery.easing.1.3.js');
	$cs->registerScriptFile(Yii::app()->baseUrl . '/js/jquery.fancybox-1.3.4.pack.js');   
	$cs->registerScriptFile(Yii::app()->baseUrl . '/js/jquery.epicHover-fadeZoom.js');
	$cs->registerScriptFile(Yii::app()->baseUrl . '/js/jquery.epicfullscreen.js');   
	$cs->registerScriptFile(Yii::app()->baseUrl . '/js/jquery.epicslider.js');
	$cs->registerScriptFile(Yii::app()->baseUrl . '/js/jquery.mobile-touch-swipe-1.0.js');   
	$cs->registerScriptFile(Yii::app()->baseUrl . '/js/jquery.isotope.min.js');
	$cs->registerScriptFile(Yii::app()->baseUrl . '/js/settings.js');   
	$cs->registerScriptFile(Yii::app()->baseUrl . '/js/common.js');
	$cs->registerScriptFile(Yii::app()->baseUrl . '/js/udt_shortcodes.js');
	$cs->registerScriptFile(Yii::app()->baseUrl . '/js/jquery.inview.js');
	$cs->registerScriptFile(Yii::app()->baseUrl . '/js/contact.js');
	$cs->registerScriptFile(Yii::app()->baseUrl . '/js/jquery.masonry.js');
	$cs->registerScriptFile(Yii::app()->baseUrl . '/js/masonry.min.js');
	$cs->registerScriptFile(Yii::app()->baseUrl . '/js/jquery.inview.js');
	$cs->registerScriptFile(Yii::app()->baseUrl . '/js/main.jquery.js');
	$cs->registerScriptFile(Yii::app()->baseUrl . '/js/system.jquery.js');
    
	$cs->registerScriptFile(Yii::app()->baseUrl . '/packages/bootstrap/js/bootstrap.min.js');
	$cs->registerCssFile(Yii::app()->baseUrl . '/packages/bootstrap/css/bootstrap.css');
	
    $cs->registerCssFile(Yii::app()->baseUrl . '/css/jquery.fancybox-1.3.4.css');
    $cs->registerCssFile(Yii::app()->baseUrl . '/css/epicfullscreen.css');
    $cs->registerCssFile(Yii::app()->baseUrl . '/css/epicslider.css');
	$cs->registerCssFile(Yii::app()->baseUrl . '/css/style.css');
	$cs->registerCssFile(Yii::app()->baseUrl . '/css/udt_shortcodes.css');
	$cs->registerCssFile(Yii::app()->baseUrl . '/css/skin.css');
	$cs->registerCssFile(Yii::app()->baseUrl . '/css/system.css');
	$cs->registerCssFile(Yii::app()->baseUrl . '/css/udt_media_queries.css');
	$cs->registerCssFile(Yii::app()->baseUrl . '/css/flexslider.css');
	
	?>
	<?=SeoHelper::getInstance()->renderMetaTags(); ?>
</head>

<body class="home page">
<!-- Google Tag Manager -->
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-KH4XL9"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-KH4XL9');</script>
<!-- End Google Tag Manager -->

<?php  if(Yii::app()->user->checkAccess('admin')):?>
   <div class = "b-admin_menu">
       <nav class="navbar navbar-static-top navbar-default" role="navigation">
           <div class="container"> 
                <?php 

                 
                     $this->renderPartial('//layouts/parts/_admin_menu');
                 ?>
                <div class="sidebar-nav-exit">
               <a href="<?= Yii::app()->createUrl('/user/auth/logout') ?>">Выйти</a>
                 </div>      
                
            </div>
       </nav>
   </div>
   <?php endif;?>
<!-- Start Header -->
	<div id="header-wrapper">
		<div id="header-inner">
			<header>

				<!-- Logo -->
				<div id="logo">
					<a href="/" title="">
						<img src="/images/logo.png" alt="" />
					</a>
				</div>

				<!-- MobileMenu Toggle -->
				<div class="mobileMenuToggle"><a href="/"></a></div>

				<!-- Navigation -->
				<nav id="primary-nav">
					<div class="menu-menu-1-container menu">
						<ul id="menu-menu-1">
							<li class="menu-item current-menu-item current_page_item"><a href="/">Главная</a></li>
							<li class="menu-item"><a href="#">портфолио</a>
							<ul class="sub-menu">
									<li class="menu-item"><a href="<?=Yii::app()->createUrl('/portfolio/view/index', ['type'=>'photo']); ?>">фото</a></li>
									<li class="menu-item"><a href="<?=Yii::app()->createUrl('/portfolio/view/index', ['type'=>'video']); ?>">видео</a></li>
									<!--<li class="menu-item"><a href="/">Portfolio 4 columns</a></li>
									<li class="menu-item"><a href="/">Portfolio full width</a></li>-->
							</ul>
							</li>
							<li class="menu-item"><a href="<?=Helper::getPageLink(3);?>">о нас</a></li>
							<li class="menu-item"><a href="<?=Helper::getPageLink(4);?>">услуги</a></li>
							<li class="menu-item"><a href="<?=Yii::app()->createUrl('blog/view/index');?>">блог</a></li>
							<li class="menu-item"><a href="<?=Yii::app()->createUrl('site/contact');?>">контакты</a></li>
							<li class="menu-item"><a href="<?=Yii::app()->createUrl('/opinion/view/index');?>">отзывы</a></li>
						</ul>
					</div>
				</nav>

			</header>
			<div class="clear"></div>
		</div>

		<div class="clear"></div>
	</div>
<?=$content?>
<div class="clear"></div>
<!-- Footer -->
	<div id="footer-wrapper">
		<div id="footer-bottom">
			<div id="footer-bottom-inner-wrapper">
				<footer>
					<!-- Logo Footer -->
					<div id="logo-footer">
						DARAGANOVY
					</div>

					<!-- "Back to Top" link -->
					<a class="back-to-top" title="Back to top" href="/">Back to top</a>

					<!-- Copyright Info -->
					<p class="footer-copyright">&copy; Powered by <a href="http://365-solutions.com/ " title="365-solutions.com ">365-solutions.com/</a></p>
				</footer>
			</div>
		</div>

	</div>

</body>
</html>

