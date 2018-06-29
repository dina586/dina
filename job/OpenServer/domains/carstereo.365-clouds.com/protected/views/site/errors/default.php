<!DOCTYPE html>
<!--[if IE 8]> <html class="no-js lt-ie9"> <![endif]-->
<!--[if IE 9]> <html class="no-js lt-ie10"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js"> <!--<![endif]-->
	<head>
		<meta charset="utf-8">

		<title>Error - <?= $error['code'] ?></title>

		<meta name="author" content="wemadefoxnever">
		<meta name="robots" content="noindex, nofollow">

		<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1.0">

		<link rel="shortcut icon" href="/themes/admin/img/favicon.png">
		<link rel="stylesheet" href="/themes/admin/css/bootstrap.min.css">
        <link rel="stylesheet" href="/themes/admin/css/plugins.css">
        <link rel="stylesheet" href="/themes/admin/css/main.css">
        <link rel="stylesheet" href="/themes/admin/css/themes.css">

		<script src="/themes/admin/js/vendor/modernizr-respond.min.js"></script>


	</head>
	<body>

		<!-- Error Container -->
        <div id="error-container">
            <div class="error-options">
                <h3>
					<i class="fa fa-chevron-circle-left text-muted"></i> 
					<a href="<?=Yii::app()->createUrl('site/index')?>"><?= Yii::t('admin', 'Go Back') ?></a>
				</h3>
            </div>
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2 text-center">
                    <h1><i class="fa <?=$displayMessage['icon']?> animation-pulse"></i> <?= $error['code'] ?></h1>
                    <h2 class="h3"><?=$displayMessage['message']?></h2>

					<?php if (DEV_MODE): ?>
						<div class =" block full">
							<p><?= $error['message'] ?></p>
							<p><?= $error['file'] ?> on line <?= $error['line'] ?></p>
							<p class = "text-left"><?= str_replace('#', '<br/>', $error['trace']) ?></p>
						</div>
					<?php endif; ?>

                </div>
            </div>
        </div>
        <!-- END Error Container -->
	
	</body>
</html>
