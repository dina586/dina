<!DOCTYPE html>
<html lang="<?=Yii::app()->language;?>">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php 
		$cs=Yii::app()->clientScript;
		$cs->registerCssFile(Yii::app()->baseUrl . '/packages/bootstrap/css/bootstrap.css');
		$cs->registerCssFile(Yii::app()->baseUrl . '/css/admin.css');
	?>
	<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<?php Yii::app()->controller->widget('ext.seo.widgets.SeoHead',array(
	   	'defaultDescription'=>'',
	    'defaultKeywords'=>'',
	)); ?>
</head>

<body>
	<div class = "b-site_error">
		<?=$content;?>
	</div>
	
</body>
</html>