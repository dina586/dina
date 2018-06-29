<!DOCTYPE html>
<html lang="<?=Yii::app()->language; ?>">
	<head>
		<meta charset="utf-8" />
		<meta name = "format-detection" content = "telephone=no">
		<link rel="icon" type="image/vnd.microsoft.icon" href="/images/favicon.ico">
		<link rel="SHORTCUT ICON" href="/images/favicon.ico">
		<link href='//fonts.googleapis.com/css?family=Roboto:300,400,700' rel='stylesheet' type='text/css'>
		<?php
		Yii::app()->getClientScript()->registerCoreScript('jquery');
		$cs = Yii::app()->clientScript;
		$cs->registerScriptFile(Yii::app()->baseUrl.'/packages/bootstrap/js/bootstrap.min.js');
		$cs->registerPackage('site_theme');
		$cs->registerScriptFile(Yii::app()->baseUrl.'/js/system.jquery.js');
		$cs->registerScriptFile(Yii::app()->baseUrl.'/js/main.jquery.js');
		$cs->registerCssFile(Yii::app()->baseUrl.'/packages/bootstrap/css/bootstrap.site.css');
		$cs->registerCssFile(Yii::app()->baseUrl.'/css/admin.css');
		$cs->registerCssFile(Yii::app()->baseUrl.'/css/site.css');
		?>



		<?php
		Yii::app()->controller->widget('ext.seo.widgets.SeoHead', array(
			'defaultDescription' => Settings::getVal('default_seo_description'),
			'defaultKeywords' => Settings::getVal('default_seo_keywords'),
		));
		?>



		<!--[if lt IE 9]>
	
			<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	
		<![endif]-->

		<!--[if (gt IE 9)|!(IE)]><!-->

		<script src="js/jquery.mobile.customized.min.js"></script>

		<!--<![endif]-->

		<!--[if lt IE 8]>
	
			<div style=' clear: both; text-align:center; position: relative;'>
	
				<a href="http://windows.microsoft.com/en-US/internet-explorer/products/ie/home?ocid=ie6_countdown_bannercode">
	
					<img src="http://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today.">
	
				</a>
	
			</div>
	
		<![endif]-->

		<!--[if lt IE 9]>
	
			<script src="js/html5shiv.js"></script>
	
			<link rel="stylesheet" media="screen" href="/css/ie.css">
	
		<![endif]-->





	</head>



	<body>





<?php
if (Yii::app()->user->checkAccess('admin'))
	$this->renderPartial('//layouts/parts/_admin_menu');
?>



		<div class="g-container">

			<!--======================== header ============================-->

			<header class = "g-header">

				<div class = "col-md-3 g-logo">

					<a href= "/">

						<img src = '<?php echo Yii::app()->request->baseUrl; ?>/images/site_logo.png' alt = '<?=Yii::app()->name; ?>' />

					</a>

				</div>



				<div class = "col-md-5 g-header_address_area l-align_center">

					<div class = "g-header_address">



<?php $this->widget('application.modules.block.components.GetBlocks', array('view' => 'header')); ?>



					</div>

					<div class="g-header_phone">

						<a href = "tel:+<?=Settings::getVal('phone'); ?>">

						<?=Settings::getVal('phone'); ?>

						</a>

					</div>

				</div>



				<div class = "col-md-4 g-header_area l-align_right">

					<div class = "g-social_buttons">

						<ul>

							<li class = "l-inline_block"><a href = "#"><img src = "/images/header_icon1.png" alt = "YouTube OPM"/></a></li>

							<li class = "l-inline_block"><a href = "#"><img src = "/images/header_icon2.png" alt = "Facebook OPM"/></a></li>

							<li class = "l-inline_block"><a href = "#"><img src = "/images/header_icon3.png" alt = "Yelp OPM"/></a></li>

						</ul>

					</div>



					<div class = "g-header_store">



<?php $this->renderPartial('application.modules.store.views.cart._cart'); ?>	

					</div>	



					<div class = "g-clear_fix"></div>



					<div class = "g-header_search">

						<form class="g-search_form" method="GET" action="<?=Yii::app()->createUrl('search/view/search') ?>" id="search">

							<input type="text" placeholder="Search for OPM Service and Products" name="q">

							<button><span class="fa-search"></span></button>

						</form>

					</div>



				</div>



			</header>



			<div class = "g-clear_fix"></div>



			<div class = "g-main_menu">

<?php
$this->widget('bootstrap.widgets.BsNavbar', array(
	'collapse' => true,
	'brandLabel' => false,
	'items' => array(
		array(
			'class' => 'bootstrap.widgets.BsNav',
			'type' => 'navbar',
			'activateParents' => true,
			'items' => array(
				array(
					'label' => Yii::t('admin', 'Home'),
					'url' => array('/site/front'),
				),
				array(
					'label' => Yii::t('admin', 'About'),
					'url' => array('/page/view/view', 'url' => Helper::getPageUrl(2)),
					'items' => array(
						array(
							'label' => Yii::t('admin', 'About OPM®'),
							'url' => array('/page/view/view', 'url' => Helper::getPageUrl(2)),
						),
						array(
							'label' => Yii::t('admin', 'F.A.Q.'),
							'url' => array('/page/view/view', 'url' => Helper::getPageUrl(3)),
						),
					),
				),
				array(
					'label' => Yii::t('admin', 'Services'),
					'url' => array('/service/view/index'),
					'items' => array(
						array(
							'label' => Yii::t('admin', 'View Services'),
							'url' => array('/service/view/index'),
						),
						array(
							'label' => Yii::t('admin', 'Gallery'),
							'url' => array('/service/gallery/index'),
						),
					),
				),
				array(
					'label' => Yii::t('admin', 'Online Store'),
					'url' => array('/store/catalog/index'),
				),
				array(
					'label' => Yii::t('admin', 'Video Tutorials'),
					'url' => array('/video/view/index'),
				),
				array(
					'label' => Yii::t('admin', 'OPM Training'),
					'url' => array('/page/view/view', 'url' => Helper::getPageUrl(7)),
					'items' => array(
						array(
							'label' => Yii::t('admin', 'OPM Internship'),
							'url' => array('/page/view/view', 'url' => Helper::getPageUrl(8)),
						),
						array(
							'label' => Yii::t('admin', 'OPM WorkShop for Certification'),
							'url' => array('/page/view/view', 'url' => Helper::getPageUrl(4)),
						),
					),
				),
				array(
					'label' => Yii::t('admin', 'Trade Shows'),
					'url' => array('/trade/view/index'),
				),
				array(
					'label' => Yii::t('admin', 'Contact us'),
					'url' => array('/site/contact'),
				),
				array(
					'label' => Yii::t('admin', 'Login'),
					'url' => array('/user/login'),
					'visible' => Yii::app()->user->isGuest
				),
				array(
					'label' => Yii::t('admin', 'Logout'),
					'url' => array('/user/logout'),
					'visible' => !Yii::app()->user->isGuest
				),
			),
		),
	)
));
?>

			</div>



				<?php
				echo $content;
				?>

			<div class = "g-clear_fix"></div>

		</div>



		<!--======================== footer ============================-->

		<footer class = "g-footer_wrap">

			<div class = "g-footer">

				<div class = "col-md-4">

					<div class = "g-footer_icon">

						<span class="fa-home"></span>

					</div>

					<div class = "g-footer_content">

						<ul>

							<li><a href = "#">OPM® Medi Spa</a></li>

							<li><a href = "#">OPM® Laser Hair Removal</a></li>

							<li><a href = "#">OPM® Medical</a></li>

							<li><a href = "#">OPM® Permanent Make-Up</a></li>

							<li><a href = "#">OPM® Microdermabrasion</a></li>

							<li><a href = "#">OPM® Photo Facial</a></li>

							<li><a href = "#">OPM® Botox & Juvederm</a></li>

							<li><a href = "#">OPM® Eyelash Perming and Tint</a></li>

							<li><a href = "#">OPM® Hair Pigmentation</a></li>

						</ul>

					</div>

					<div class = "g-clear_fix"></div>

				</div>

				<div class = "col-md-4">

					<div class = "g-footer_icon">

						<span class="fa-envelope-o"></span>

					</div>

					<div class = "g-footer_content">

						<ul>

							<li><a href = "#">Products</a></li>

							<li><a href = "#">Services</a></li>

							<li><a href = "#">Gallery</a></li>

						</ul>

					</div>

					<div class = "g-clear_fix"></div>

				</div>



				<div class = "col-md-4">

					<div class = "g-footer_content">

						<h4>

							Contact info: 

						</h4>

						<div class="marker">

							<span class="fa-map-marker"></span>

						</div>

						<p> 12113 Santa Monica, Suite 203<br> Los Angeles, CA 90025 </p>

						<div class="marker">

							<span class="fa-phone"></span>

						</div>

						<a href = "tel:+<?=Settings::getVal('phone'); ?>"><?=Settings::getVal('phone'); ?></a>

					</div>

					<div class = "g-clear_fix"></div>

				</div>

				<div class = "g-clear_fix"></div>

				<div class = "copyright">

					<div class = "col-xs-6">

						<a href = "<?=Yii::app()->createUrl('site/front') ?>">Organic Permanent Makeup</a> © <?=date('Y') ?> All Rights Reserved

					</div>

					<div class="col-xs-6 l-align_right">Powered by <a href="http://365-solutions.com">365-solutions.com</a></div>

				</div>

				<div class = "g-clear_fix"></div>

			</div>

		</footer>



	</body>

</html>

