<?php

/**
 * @author Nicholas Kobets <wemadefoxnever@gmail.com>
 * @copyright 365-solutions.com
 * @license http://365-solutions.com/general-license
 */
$packages = array(
	
	/**
	 * System
	 */
	'bootstrap' => array(
		'basePath' => 'webroot.packages.bootstrap',
		'js' => array(
			DEV_MODE ? 'js/bootstrap.js' : 'js/bootstrap.min.js',
		),
		'css' => DEV_MODE ? array('css/bootstrap.css') : array('css/bootstrap.min.css'),
		'depends' => array('jquery'),
	),
	'admin_theme' => array(
		'basePath' => 'webroot.themes.admin',
		'js' => array(
			'js/vendor/modernizr-respond.min.js',
		),
		'css' => array('css/bootstrap.min.css', 'css/plugins.css', 'css/main.css', 'css/themes.css'),
		'depends' => array('jquery'),
	),
	'ajaxForm' => array(
		'basePath' => 'webroot.packages.ajaxForm',
		'js' => array('jquery.form.js'),
		'depends' => array('yiiactiveform', 'jquery'),
	),
	'ajaxRender' => array(
		'basePath' => 'webroot.packages.history',
		'js' => array('ajax_render.js', 'jquery.history.js'),
		'depends' => array('jquery'),
	),
	'confirm' => array(
		'basePath' => 'webroot.packages.confirm',
		'js' => array('jquery.confirm.min.js'),
		'depends' => array('jquery'),
	),
	
	
	/**
	 * Gallery
	 */
	'lightbox' => array(
		'basePath' => 'webroot.packages.lightbox',
		'js' => array('lightbox.js'),
		'css' => array('lightbox.css'),
		'depends' => array('jquery'),
	),
	'photobox' => array(
		'basePath' => 'webroot.packages.photobox',
		'js' => array('photobox.js'),
		'css' => array('photobox.css'),
		'depends' => array('jquery'),
	),

	/**
	 * Sliders
	 */
	'jcarousel' => array(
		'basePath' => 'webroot.packages.jcarousel',
		'js' => array('jquery.jcarousel.min.js'),
		'css' => array('jcarousel.css'),
		'depends' => array('jquery'),
	),
	'bxsLider' => array(
		'basePath' => 'webroot.packages.bxsLider',
		'js' => array('js/jquery.bxslider.min.js'),
		'css' => array('css/jquery.bxslider.css'),
		'depends' => array('jquery'),
		),
	'flexslider' => array(
		'basePath' => 'webroot.packages.flexslider',
		'js' => array('jquery.flexslider-min.js'),
		'css' => array('flexslider.css'),
		'depends' => array('jquery', 'revolution_slider'),
	),
	'revolution_slider' => array(
		'basePath' => 'webroot.packages.revolution_slider',
		'js' => array('js/jquery.themepunch.plugins.min.js','js/jquery.themepunch.revolution.min.js'),
		'css' => array('css/settings.css', 'css/style.css'),
		'depends' => array('jquery'),
	),
	
	
	/**
	 * Helpers
	 */
	'searchHighlights' => array(
		'basePath' => 'webroot.packages.searchHighlights',
		'js' => array('jquery.highlight-3.js'),
		'depends' => array('jquery'),
	),
	
	'jscrop' => [
		'basePath' => 'webroot.packages.jscrop',
		'js' => ['jquery.jcrop.min.js'],
		'css' => ['jquery.jcrop.min.css'],
		'depends' => ['jquery'],
	],
	
	/**
	 * Site
	 */
	
	'travello' => [
		'basePath' => 'webroot.packages.travello',
		'js' => ['js/modernizr.2.7.1.min.js', 'js/jquery-migrate-1.2.1.min.js', 'js/jquery.placeholder.js', 'js/jquery.stellar.min.js', 'js/theme-scripts.js'],
		'css' => ['css/font-awesome.min.css', 'css/animate.min.css', 'css/animate.min.css', 'css/style.css', 'css/responsive.css'],
		'depends' => ['jquery', 'bootstrap'],
	],
);

return $packages;
