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
		<link rel="stylesheet" type="text/css" href="http://cdn.bootcss.com/animate.css/3.1.0/animate.css">
		<?=SeoHelper::getInstance()->renderMetaTags() ?>

	</head>

    <body>
		<?php
			if(Yii::app()->user->checkAccess('admin'))
				$this->renderPartial('//layouts/parts/_top_menu');
		?>

		<div class = "g-container">
			<header class = "g-header">
				<div class = "g-site_width">
					<div class = "g-header_menu j-header_menu">
						<span></span>
						<span></span>
						<span></span>
					</div>
					<div class = "g-header_address">
						<p><?=Settings::getVal('header_address')?></p>
					</div>
					<div class = "g-header_logo">
						<a href = "/"><img src = "/images/kinex_logo_white.png" alt = "Gira"/></a>
					</div>
					<div class = "g-header_contacts">
						<p><a href = "tel:<?=Settings::getVal('header_phone')?>"><?=Settings::getVal('header_phone')?></a></p>
						<a href = "#" class = "j-show_call_dialog">Заказать звонок</a>
					</div>
					<div class = "g-clear_fix"></div>
				</div>				
			</header>
			
			<nav class = "g-main_menu j-main_menu">
				<ul>
					<li><a data-hash = "capabilities" href = "<?=Yii::app()->createUrl('/#capabilities')?>">Возможности "Умного дома"</a></li>
					<li><a data-hash = "choose" href = "<?=Yii::app()->createUrl('/#choose')?>">Преимущества </a></li>
					<li><a data-hash = "show" href = "<?=Yii::app()->createUrl('/#show')?>">Шоу-рум</a></li>
					<li><a data-hash = "projects" href = "<?=Yii::app()->createUrl('/#projects')?>">Наши работы</a></li>
					<li><a data-hash = "opinions" href = "<?=Yii::app()->createUrl('/#opinions')?>">Отзывы</a></li>
				</ul>
			</nav>
			
			<div class = "g-clear_fix"></div>
				<?=$content;?>
			<div class = "g-clear_fix"></div>
			
			<footer class = "g-footer">
				<div class = "g-site_width">
					<?php $this->widget('application.modules.block.components.GetBlocks', array('view' => 'footer')); ?>
				</div>
			</footer>
        </div>
		<a href="#top" id="toTop"></a>

		<?php
		$cs = Yii::app()->clientScript;
		$cs->registerCoreScript('jquery');
		$cs->registerPackage('bootstrap');
		$cs->registerScriptFile('http://html5shiv.googlecode.com/svn/trunk/html5.js', CClientScript::POS_END, array('media' => 'lt IE 9'));
		$cs->registerScriptFile(Yii::app()->baseUrl.'/packages/rotate/rotate.js');
		$cs->registerScriptFile('http://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.4/waypoints.min.js');
		$cs->registerScriptFile(Yii::app()->baseUrl.'/packages/scrolltop/scrolltop.js');
		$cs->registerScriptFile(Yii::app()->baseUrl.'/js/system.jquery.js');
		$cs->registerScriptFile(Yii::app()->baseUrl.'/js/main.jquery.js');
		$cs->registerCssFile(Yii::app()->baseUrl.'/css/system.css');
		$cs->registerCssFile(Yii::app()->baseUrl.'/css/main.css');
		?>
		
		<?php 
			$this->widget('application.widgets.CallFormWidget');
		?>

    </body>
</html>

