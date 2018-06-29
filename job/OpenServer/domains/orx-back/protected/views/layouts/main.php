<!DOCTYPE html>
<html lang="en" xml:lang="en">
<head>
	<meta charset="utf-8" />
	
	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/lib/jcarousel/gallery_slider.css" />
	<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery.lightbox-0.5.css" />
	<?php 
	$cs=Yii::app()->clientScript;
	Yii::app()->getClientScript()->registerCoreScript('jquery');
	$cs->registerPackage('dropdownmenu');
	$cs->registerScriptFile(Yii::app()->baseUrl . '/lib/jcarousel/jquery.jcarousel.min.js');
	$cs->registerScriptFile(Yii::app()->baseUrl . '/js/plugins/lightbox/jquery.lightbox-0.5.pack.js');
	$cs->registerScriptFile(Yii::app()->baseUrl . '/js/lib.jquery.js');
	
	$cs->registerScriptFile(Yii::app()->baseUrl . '/js/main.js');
	?>
	
	<?php Yii::app()->controller->widget('ext.seo.widgets.SeoHead',array(
	   	'defaultDescription'=>'Новый год',
	    'defaultKeywords'=>'новый, год, новый год',
	)); ?>
	<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
</head>

<body>

<?php if(!Yii::app()->user->isGuest){
	$this->widget('ext.admin-menu.AdminMenu', 
		array(
			'width'=>'1020px',
		)
	);
	}
?>
<div class = "g-container">
	<div class = "g-add_to_cart_mess j-add_to_cart_mess"><p>Товар добавлен в корзину</p></div>
	<header class = "g-header">
		<?php 
			$block = Block::viewBlock(1);
			foreach($block as $view){
				echo $view['description'];
				echo '<div class = "g-clear_fix"></div>';
			}
		?>
	</header>
	<div class = "g-clear_fix"></div>
		<?php $this->beginContent('//layouts/_main_menu'); ?>
		
		<?php $this->endContent(); ?>
	<div class = "g-clear_fix"></div>
	<div class = "b-main_search">
		<form action = "<?php echo Yii::app()->createUrl('search/search');?>" method = "get">
			<input type = "text" name = "q" value = "" class = "search_field"/>
			<button class = "search_button">Найти</button>
			<div class = "g-clear_fix"></div>
		</form>
	</div>
	<div class = "g-header_line"></div>
	<div class = "g-clear_fix"></div>
	
	<div class = "g-slider_area">	
		<div class = "g-slider">
		<?php 
			$data = Product::sliderDataMain();
			if(count($data)>0){
		?>
			<ul id="slider" class="jcarousel-skin-tango">
				<?php
					foreach($data as $view) {
						
						$url = Yii::app()->createUrl('shop/product/view', array('url'=>$view['url']));
						 echo '<li>
							<a href = "'.$url.'">'.$view['name'].'</a>
							<img src = "/upload/shop/'.$view['id'].'.jpg"/>
						</li>';
					}
				?>
			</ul>
		<?php } else{
			echo '<img src = "/images/SLIDER.jpg"/>';
		}?>
			<div class = "g-collection">
			<?php $data = Catalog::model()->findAll(array('condition'=>'view_on_main=1', 'order'=>'position', 'limit'=>3));
			if(count($data)>0) {
				foreach($data as $view) {
					$url = Yii::app()->createUrl('shop/catalog/view', array('url'=>$view->url));
					echo '<section style = "background:url('.Yii::app()->request->baseUrl.'/upload/catalog/'.$view->id.'.jpg)">
						<a href = "'.$url.'" class = "l-link">'.$view->name.'</a>
					</section>';
				}
			}
			?>
			</div>
		</div>
		<div class = "g-links">
			<section class = "g-link1">
				<a href = "<?=Yii::app()->createUrl('/shop/catalog')?>" class = "l-link">
					<span>вся </span>
					коллекция 
				</a>
			</section>
			<div class = "g-link2">
				<a href = "<?=Yii::app()->createUrl('/shop/product/share')?>">
					<img src = "/images/all_umbrella1.jpg" />
				</a>
				<?php 
					$block = Block::viewBlock(2);
					foreach($block as $view){
						echo $view['description'];
						echo '<div class = "g-clear_fix"></div>';
					}
				?>
			</div>
		</div>
	</div>
	
	<div class = "g-clear_fix"></div>
	
	<div class = "g-content">
		<?php echo $content; ?>
	<div class = "g-clear_fix"></div>
	
	<footer class = "g-footer">
		<?php if(Yii::app()->controller->id == 'site' &&  Yii::app()->controller->action->id == 'index'):?>
		<section class = "b-preview">
			<?php 
				$content = Content::model()->findByPk(4);
				echo $content->description; 
			?>
		</section>
		<?php endif;?>
		
		<section class = "b-preview">
		<?php 
			$block = Block::viewBlock(3);
			foreach($block as $view){
				echo $view['description'];
				echo '<div class = "g-clear_fix"></div>';
			}
		?>
		</section>
		<div id="myslidemenu" class="jqueryslidemenu">
			<ul>
				<li>
					<a href = "/">главная</a>
				</li>
				<li>
					<a href = "<?=Yii::app()->createUrl('/site/page', array('view'=>'about'));?>">о компании</a>
				</li>
				<li>
					<a href = "<?=Yii::app()->createUrl('/shop/catalog')?>">цены</a>
				</li>
				<li>
					<a href = "<?=Yii::app()->createUrl('/site/page', array('view'=>'delivery'));?>">доставка</a>
				</li>
				<li>
					<a href = "<?=Yii::app()->createUrl('/about')?>">Информация</a>
				</li>
				<li>
					<a href = "<?=Yii::app()->createUrl('/gallery')?>">фото</a>
				</li>
				<li>
					<a href = "<?=Yii::app()->createUrl('/opinions')?>">отзывы</a>
				</li>
				<li class = "r-last">
					<a href = "<?=Yii::app()->createUrl('/site/contact');?>">контакты</a>
				</li>
			</ul>
		</div>

		<div class = "g-clear_fix"></div>
			<?php 
				$block = Block::viewBlock(4);
				foreach($block as $view){
					echo $view['description'];
					echo '<div class = "g-clear_fix"></div>';
				}
				?>
		
		
	</footer>
	<div class = "g-clear_fix"></div>
	</div>
</div>
<!-- Yandex.Metrika counter -->
<script type="text/javascript">
(function (d, w, c) {
    (w[c] = w[c] || []).push(function() {
        try {
            w.yaCounter21762367 = new Ya.Metrika({id:21762367,
                    webvisor:true,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true});
        } catch(e) { }
    });

    var n = d.getElementsByTagName("script")[0],
        s = d.createElement("script"),
        f = function () { n.parentNode.insertBefore(s, n); };
    s.type = "text/javascript";
    s.async = true;
    s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

    if (w.opera == "[object Opera]") {
        d.addEventListener("DOMContentLoaded", f, false);
    } else { f(); }
})(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="//mc.yandex.ru/watch/21762367" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
</body>
</html>
