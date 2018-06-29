<!DOCTYPE html>
<html lang="<?= Yii::app()->language; ?>">
	<head>
		<meta charset="utf-8" />
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<meta name="HandheldFriendly" content="true" />
		<meta name="apple-touch-fullscreen" content="yes" />

		<link rel="icon" type="image/vnd.microsoft.icon" href="/images/favicon.ico">
        <link rel="SHORTCUT ICON" href="/images/favicon.ico">
	</head>

    <body>
		<?php
		/*if(Yii::app()->user->checkAccess('admin'))
			$this->renderPartial('//layouts/parts/_admin_menu');
		 */
		?>

    <div class = "g-container">
        <header class="g-header">			
            <section class="g-logo">
                    <a href="/">
                            <img src="/images/logo.png" alt="Агроусадьбы, коттеджи, базы отдыха Беларуси">
                    </a>
            </section>				
	</header>
        <div class="g-clear_fix"></div>
        <div class="g-menu_wrap">
		<section class="g-menu_left"></section>
		<nav class="navbar navbar-static-top navbar-default" role="navigation">
                    <div class="container">
                        <div class="navbar-header">
                            <button class="navbar-toggle" data-toggle="collapse" data-target="#yw2" type="button">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="collapse navbar-collapse" id="yw2">
                            <ul id="yw1" class="nav navbar-nav" role="menu">
                                <li class="active"><a tabindex="-1" href="/">Главная</a></li>
                                <li><a tabindex="-1" href="/showplace">Достопримечательности</a></li>
                                <li><a tabindex="-1" href="/news">Объявления</a></li>
                                <li><a tabindex="-1" href="/article">Статьи</a></li>
                                <li><a tabindex="-1" href="/contacts">Контакты</a></li>
                            </ul>
                        </div>
                    </div>
                </nav>		
                <section class="g-menu_right"></section>
	</div>
        <div class="g-clear_fix"></div>
            <?=$content?>
        <div class="g-clear_fix"></div>
        <div class="g-clear_fix"></div>
        <footer class="g-footer">		
            <div class="l-left">
                <p><a href="http://dvn.by">dvn.by</a></p>
                <p>создание сайтов</p>
            </div>			
            <div class="l-right l-align_right">
                    <p><a href="http://farmstay.by">farmstay.by</a></p>
                    <p>официальный сайт</p>
            </div>		
            <section class="g-clear_fix"></section>
	</footer>
    </div>

		<?php
		$cs = Yii::app()->clientScript;
		$cs->registerCoreScript('jquery');
		$cs->registerPackage('bootstrap');
		$cs->registerScriptFile('http://html5shiv.googlecode.com/svn/trunk/html5.js', CClientScript::POS_END, array('media' => 'lt IE 9'));
		$cs->registerScriptFile(Yii::app()->baseUrl . '/js/system.jquery.js');
		$cs->registerScriptFile(Yii::app()->baseUrl . '/js/main.jquery.js');
		$cs->registerCssFile(Yii::app()->baseUrl . '/css/system.css');
		$cs->registerCssFile(Yii::app()->baseUrl . '/css/main.css');
		?>
    </body>
</html>

