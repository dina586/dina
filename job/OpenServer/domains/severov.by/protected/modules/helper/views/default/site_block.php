<!DOCTYPE html>
<html lang="<?=Yii::app()->language;?>">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<?php
		$cs=Yii::app()->clientScript;
		$cs->registerCssFile(Yii::app()->baseUrl . '/packages/bootstrap/css/bootstrap.css');
	?>
</head>

<body>
	<div class = "b-site_is_not_available container" style = "text-align: center">
		<h1>This site is blocked for non-payment.</h1>
	</div>
</body>
</html>