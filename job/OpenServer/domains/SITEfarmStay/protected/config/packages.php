<?php
$packages = array(
	'bootstrap'=>array(
		'basePath'=>'webroot.packages.bootstrap',
		'js' => array(
			DEV_MODE ? 'js/bootstrap.js' : 'js/bootstrap.min.js',
		),
		'css' => DEV_MODE ? array( 'css/bootstrap.css'):array('css/bootstrap.min.css'),
		'depends' => array('jquery'),
	),
	'admin_theme'=>array(
		'basePath'=>'webroot.themes.admin',
		'js' => array(
			'/js/vendor/modernizr-respond.min.js',
		),
		'css' => array('css/bootstrap.min.css', 'css/plugins.css', 'css/main.css', 'css/themes.css'),
		'depends' => array('jquery'),
	),

    'store'=>array(
		'basePath'=>'application.modules.store.assets',
		'js' => array('store.jquery.js'),
		'css' => array('store.css'),
		'depends' => array('jquery'),
	),
	'ajaxForm'=>array(
		'basePath'=>'webroot.packages.ajaxForm',
		'js'=>array('jquery.form.js'),
		'depends'=>array('yiiactiveform', 'jquery'),
	),
	'ajaxRender'=>array(
		'basePath'=>'webroot.packages.history',
		'js'=>array('ajax_render.js', 'jquery.history.js'),
		'depends'=>array('jquery'),
	),
	'lightbox'=>array(
		'basePath'=>'webroot.packages.lightbox',
		'js'=>array('lightbox.js'),
		'css'=>array('lightbox.css'),
		'depends'=>array('jquery'),
	),
	'zoombox'=>array(
		'basePath'=>'webroot.packages.zoombox',
		'js'=>array('zoombox.js'),
		'css'=>array('zoombox.css'),
		'depends'=>array('jquery'),
	),
	'colorbox'=>array(
		'basePath'=>'webroot.packages.colorbox',
		'js'=>array('jquery.colorbox-min.js'),
		'css'=>array('colorbox.css'),
		'depends'=>array('jquery'),
	),
	'searchHighlights'=>array(
		'basePath'=>'webroot.packages.searchHighlights',
		'js'=>array('jquery.highlight-3.js'),
		'depends'=>array('jquery'),
	),
	'photobox'=>array(
		'basePath'=>'webroot.packages.photobox',
		'js' => array('photobox.js'),
		'css'=>array('photobox.css'),
		'depends' => array('jquery'),
	),
	'scroll'=>array(
		'basePath'=>'webroot.packages.scroll',
		'js' => array('scroll.jquery.js'),
		'css'=>array('scroll.css'),
		'depends' => array('jquery'),
	),
	'nicescroll'=>array(
		'basePath'=>'webroot.packages.nicescroll',
		'js' => array('jquery.nicescroll.min.js'),
		'depends' => array('jquery'),
	),
	'slidesjs'=>array(
		'basePath'=>'webroot.packages.slidesjs',
		'js' => array('slides.jquery.js'),
		'depends' => array('jquery'),
	),
	'gallery'=> array(
		'basePath'=>'application.modules.gallery.assets',
		'js' => array(
			'gallery.jquery.js',
		),
		'css' => array(
			'gallery.css',
		),
		'depends'=>array('jquery', 'jquery.ui', 'photobox'),
	),
	'jcarousel'=>array(
		'basePath'=>'webroot.packages.jcarousel',
		'js' => array('jquery.jcarousel.min.js'),
		'css'=>array('jcarousel.css'),
		'depends' => array('jquery'),
	),
	'lazy'=>array(
		'basePath'=>'webroot.packages.lazyload',
		'js' => array('jquery.lazy.min.js'),
		'depends' => array('jquery'),
	),
	'countdown'=>array(
		'basePath'=>'webroot.packages.countdown',
		'js' => array('jquery.countdown.js', 'jquery.countdown-ru.js'),
		'depends' => array('jquery'),
	),

	'choosen'=>array(
		'basePath'=>'webroot.packages.choosen',
		'js' => array('chosen.jquery.min.js', 'chosen.proto.min.js'),
		'css'=>array('chosen.min.css'),
		'depends' => array('jquery'),
	),
	'phonemask'=>array(
		'basePath'=>'webroot.packages.phonemask',
		'js' => array('phone_mast.min.js'),
		'depends' => array('jquery'),
	),
	'mask'=>array(
		'basePath'=>'webroot.packages.mask',
		'js' => array('jquery.mask.min.js'),
		'depends' => array('jquery'),
	),
	'scrollbar'=>array(
		'basePath'=>'webroot.packages.scrollbar',
		'js' => array('perfect-scrollbar.js'),
		'css'=>array('perfect-scrollbar.css'),
		'depends' => array('jquery'),
	),
	'service'=>array(
		'basePath'=>'application.modules.service.assets',
		'js' => array('service.jquery.js'),
		'depends' => array('jquery'),
	),
	'confirm'=>array(
		'basePath'=>'webroot.packages.confirm',
		'js' => array('jquery.confirm.min.js'),
		'depends' => array('jquery'),
	),
	'jsignature'=>array(
		'basePath'=>'webroot.packages.jsignature',
		'js' => array('flashcanvas.js', 'jSignature.min.js'),
		'depends' => array('jquery'),
	),
	'flexslider'=>array(
		'basePath'=>'webroot.packages.flexslider',
		'js' => array('jquery.flexslider.min.js'),
		'css' => array('flexslider.css'),
		'depends' => array('jquery'),
	),
	'photoswipe'=>array(
		'basePath'=>'webroot.packages.photoswipe',
		'js' => array('photoswipe.min.js', 'photoswipe-ui-default.min.js'),
		'css' => array('photoswipe.css'),
		'depends' => array('jquery'),
	),
	'swipebox'=>array(
		'basePath'=>'webroot.packages.swipebox',
		'js' => array('jquery.swipebox.min.js'),
		'css' => array('swipebox.min.css'),
		'depends' => array('jquery'),
	),
	'site_theme'=>array(
		'basePath'=>'webroot.packages.site_theme',
		'js' => array(
			'jquery.easing.1.3.js',
			'jquery.ui.totop.js',
		),
		'depends' => array('jquery'),
	),
	

);

return $packages;