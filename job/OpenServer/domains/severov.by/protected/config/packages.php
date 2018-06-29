<?php
$packages = array(
    'store'=>array(
		'basePath'=>'application.modules.store.assets',
		'js' => array('store.jquery.js'),
		'css' => array('store.css'),
		'depends' => array('jquery'),
	),
	'jcarousel'=>array(
		'basePath'=>'webroot.packages.jcarousel',
		'js' => array(
			'jquery.jcarousel.min.js',
		),
		'css'=>array(
			'gallery_slider.css',
		),
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
	'bootstrap'=>array(
		'basePath'=>'webroot.packages.bootstrap',
		'js' => array('bootstrap.min.js'),
		'css' => array('bootstrap-theme.css', 'bootstrap.css'),
		'depends' => array('jquery'),
	),
	
);

return $packages;