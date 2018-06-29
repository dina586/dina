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
	'galleria'=>array(
		'basePath'=>'webroot.packages.galleria',
		'js' => array('galleria-1.4.2.min.js'),
		'css' => array('galleria.classic.css'),
		'depends' => array('jquery'),
	),
	'fancybox'=>array(
		'basePath'=>'webroot.packages.fancybox',
		'js' => array('jquery.fancybox.js'),
		'css' => array('jquery.fancybox.css'),
		'depends' => array('jquery'),
	),
	'mask'=>array(
		'basePath'=>'webroot.packages.mask',
		'js' => array('jquery.mask.min.js'),
		'depends' => array('jquery'),
	),

);

return $packages;
