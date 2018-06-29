<!DOCTYPE html>
<html lang="<?=Yii::app()->language;?>">
<head>
	<meta charset="utf-8" />
	<?php 
		$cs=Yii::app()->clientScript;
	
		$cs->registerCssFile(Yii::app()->baseUrl . '/css/contract.css');
		?>
</head>

<body>

<div class = "g-container">
	
	<div class = "g-header">
		<div class = "g-logo">
			<img src = "/images/logo_document.png" alt = ""/>
		</div>
		<div class = "g-header_block">
			<br/>
			<p>OPM Medi Spa</p>
			<p>12113 Santa Monica, Suite 203,</p>
			<p>Los Angeles, CA <b>90025</b></p>
			<p class = "header_color"><?=trim(Settings::getVal('phone'), '+1 ')?></p>
			
		</div>
	</div>
	
	<div class = "g-clear_fix"></div>
	
	<div class = "g-content">
		<?php echo $content; ?>
	</div>
	
	<div class = "g-clear_fix"></div>
	
	<div class = "g-footer">
		<a href = "http://organicpermanentmakeup.com">www.organicpermanentmakeup.com</a>
		<p class = "powered">Powered by 365-solutions.com</p>
	</div>
</div>
</body>
</html>