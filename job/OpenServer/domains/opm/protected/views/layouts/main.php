<!DOCTYPE html>
<html lang="<?=Yii::app()->language;?>">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=800">
	<link rel="icon" type="image/vnd.microsoft.icon" href="/images/favicon.ico">
	<link rel="SHORTCUT ICON" href="/images/favicon.ico">
	<?php Yii::app()->getClientScript()->registerCoreScript('jquery');
	$cs=Yii::app()->clientScript;
	$cs->registerPackage('colorbox');
	$cs->registerPackage('scrollbar');
	$cs->registerScriptFile(Yii::app()->baseUrl . '/js/system.jquery.js');
	$cs->registerScriptFile(Yii::app()->baseUrl . '/js/main.jquery.js');
	$cs->registerScriptFile(Yii::app()->baseUrl . '/packages/bootstrap/js/bootstrap.min.js');
	$cs->registerCssFile(Yii::app()->baseUrl . '/packages/bootstrap/css/bootstrap.css');
	$cs->registerCssFile(Yii::app()->baseUrl . '/css/main.css');
	$cs->registerCssFile(Yii::app()->baseUrl . '/css/admin.css');
	?>
	<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<?php Yii::app()->controller->widget('ext.seo.widgets.SeoHead',array(
	   	'defaultDescription'=>Settings::getVal('default_seo_description'),
	    'defaultKeywords'=>Settings::getVal('default_seo_keywords'),
	)); 
	if(Yii::app()->user->isGuest)
		Settings::getVal('google_analytics')
	?>
</head>


<body>
<div class = "g-container">

	<?php 
		$this->renderPartial('//layouts/parts/_left_column');
	?>
	
	<aside class = "c-right">
		
		<div class = "g-clear_fix"></div>
		
		<div class = "g-content">
			<?php echo $content; ?>
		</div>
		
		<div class = "g-clear_fix"></div>
	</aside>
	
</div>

<?php 
if(Yii::app()->user->isGuest)
	Settings::getVal('yandex_metric')
?>
</body>
</html>

