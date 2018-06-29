<!DOCTYPE html>
<html lang="en" xml:lang="en">
	<head>
		<meta charset="utf-8" />

		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<meta name="HandheldFriendly" content="true" />
		<meta name="apple-touch-fullscreen" content="yes" />
		
		<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
		<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
		<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/lib/jcarousel/gallery_slider.css" />
		<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery.lightbox-0.5.css" />

		<?php
		$cs = Yii::app()->clientScript;
		Yii::app()->getClientScript()->registerCoreScript('jquery');
		$cs->registerPackage('dropdownmenu');
		$cs->registerScriptFile(Yii::app()->baseUrl.'/lib/jcarousel/jquery.jcarousel.min.js');
		$cs->registerScriptFile(Yii::app()->baseUrl.'/js/plugins/lightbox/jquery.lightbox-0.5.pack.js');
		$cs->registerScriptFile(Yii::app()->baseUrl.'/js/jquery.form.js');

		$cs->registerScriptFile(Yii::app()->baseUrl.'/js/main.js');
		$cs->registerScriptFile(Yii::app()->baseUrl.'/js/default.js');
		$cs->registerScriptFile(Yii::app()->baseUrl.'/js/main.jquery.js');
		?>

		<?php
		Yii::app()->controller->widget('ext.seo.widgets.SeoHead', array(
			'defaultDescription' => 'Орхидеи',
			'defaultKeywords' => 'Орхидеи',
		));
		?>
		<!--[if lt IE 9]>
			<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
	</head>

	<body>

		<?php
		if (!Yii::app()->user->isGuest) {
			$this->widget('ext.admin-menu.AdminMenu', array(
				'width' => '957px',
					)
			);
		}
		?>
		<div class = "g-container">
			<div class = "g-add_to_cart_mess j-add_to_cart_mess"><p>Товар добавлен в корзину</p></div>
			
			<header class = "g-header">
				<div class="g-logo">                
					<a title="Перейти на главную" href="http://orx.by"><img src="/upload/files/logo-orx.png" alt=""></a>
					<div class="g-logo-text"> САМЫЕ НИЗКИЕ <span>цены в стране</span><br>ОПТОМ И В РОЗНИЦУ</div>               
				</div>
				<div class="fraight">
					<div class="g-header_tel">
						
						<?php
							$block = Block::viewBlock(1);
							foreach ($block as $view) {
								echo $view['description'];
								echo '<div class = "g-clear_fix"></div>';
							}
							?>
					</div>
					<div class="g-header_call">
						<img title="call-logo" alt="call-logo" src="/images/call-logo.png">
					</div>
					<div class = "g-clear_fix"></div>
					<div class="g-header_contacts">
						<div class="b-header_get_call">
							<a href="#" class="j-show_call_dialog btn-sm">ЗАКАЗАТЬ ЗВОНОК</a>
						</div>
					</div>
				</div>  
				<div class="g-clear_fix"></div>     
			</header>
			
			<div class = "g-clear_fix"></div>
			<?php $this->beginContent('//layouts/_main_menu'); ?>

				<?php $this->endContent(); ?>
			<div class = "g-clear_fix"></div>

			<div class = "g-header_line">
				<div class = "b-main_search">
					<form action = "<?php echo Yii::app()->createUrl('search/search'); ?>" method = "get">
						<input type = "text" name = "q" placeholder = "Пойск на сайте" class = "search_field"/>
						<a href="#"><button class = "search_button">найти</button></a>
						<div class = "g-clear_fix"></div>
					</form>
				</div>            
			</div>
			<div class = "g-clear_fix"></div>


			
		<div class = "g-clear_fix"></div>

		<div class = "g-content">
			<?php echo $content; ?>
        </div>

		<div class = "g-clear_fix"></div>
		
		<footer class = "g-footer">

			<div class = "g-clear_fix"></div>
			<?php
			  $block = Block::viewBlock(4);
			  foreach($block as $view){
				  echo $view['description'];
				  echo '<div class = "g-clear_fix"></div>';
			  }
			?>

		</footer>
		
		</div>
		
		<div class = "g-clear_fix"></div>


		<!-- Yandex.Metrika counter -->
		<script type="text/javascript">
            (function (d, w, c) {
                (w[c] = w[c] || []).push(function () {
                    try {
                        w.yaCounter21762367 = new Ya.Metrika({id: 21762367,
                            webvisor: true,
                            clickmap: true,
                            trackLinks: true,
                            accurateTrackBounce: true});
                    } catch (e) {
                    }
                });

                var n = d.getElementsByTagName("script")[0],
                        s = d.createElement("script"),
                        f = function () {
                            n.parentNode.insertBefore(s, n);
                        };
                s.type = "text/javascript";
                s.async = true;
                s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

                if (w.opera == "[object Opera]") {
                    d.addEventListener("DOMContentLoaded", f, false);
                } else {
                    f();
                }
            })(document, window, "yandex_metrika_callbacks");
		</script>
		<noscript><div><img src="//mc.yandex.ru/watch/21762367" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
		<!-- /Yandex.Metrika counter -->
		<?php
		$cs = Yii::app()->clientScript;
		$cs->registerScriptFile(Yii::app()->baseUrl.'/packages/bootstrap/js/bootstrap.min.js');
		$cs->registerCssFile(Yii::app()->baseUrl.'/packages/bootstrap/css/bootstrap.css');
		?>
		<?php
		$this->widget('application.widgets.CallFormWidget');
		?>
	</body>
</html>
