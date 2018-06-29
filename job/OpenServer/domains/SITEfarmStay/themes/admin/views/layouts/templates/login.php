<!DOCTYPE html>
<!--[if IE 8]> <html class="no-js lt-ie9"> <![endif]-->
<!--[if IE 9]> <html class="no-js lt-ie10"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js"> <!--<![endif]-->
	<head>
		<meta charset="utf-8">

		<title>ProUI - Responsive Bootstrap Admin Template</title>

		<meta name="author" content="wemadefoxnever">
		<meta name="robots" content="noindex, nofollow">

		<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1.0">

		<link rel="shortcut icon" href="<?= Yii::app()->theme->baseUrl ?>/img/favicon.png">
	</head>
	<body>
		<!-- Login Background -->
		<div id="login-background">
			<!-- For best results use an image with a resolution of 2560x400 pixels (prefer a blurred image for smaller file size) -->
			<img src="<?= Yii::app()->theme->baseUrl ?>/img/placeholders/headers/login_header.jpg" alt="Login Background">
		</div>
		<!-- END Login Background -->

		<!-- Login Container -->
		<div id="login-container" class="animation-fadeIn">
			<!-- Login Title -->
			<div class="login-title text-center">
				<h1><i class="gi gi-flash"></i> <strong><?= Settings::getVal('site_name') ?></strong>
					<br/>
					<small><?= $this->pageTitle; ?></small>
				</h1>
			</div>
			<!-- END Login Title -->

			<!-- Login Block -->
			<div class="block push-bit">
				<?= $content; ?>
			</div>
			<!-- END Login Block -->

			<!-- Footer -->
			<footer class="text-muted text-center">
				<small><?= date('Y'); ?> &copy; <a href="<?= Yii::app()->createUrl('site/index'); ?>" target="_blank"><?= Settings::getVal('site_name') ?></a></small>
			</footer>
			<!-- END Footer -->
		</div>
		<!-- END Login Container -->

		<?php
		$cs = Yii::app()->clientScript;
		$cs->registerPackage('admin_theme');
		$cs->registerScriptFile(Yii::app()->theme->baseUrl . '/js/vendor/bootstrap.min.js');
		$cs->registerScriptFile(Yii::app()->theme->baseUrl . '/js/plugins.js');
		$cs->registerScriptFile(Yii::app()->theme->baseUrl . '/js/app.js');
		?>
	</body>
</html>
