<?php

define('DS', DIRECTORY_SEPARATOR);
//Aliaces
Yii::setPathOfAlias('block_view', dirname(__FILE__) . DS . '..' . DS . 'modules' . DS . 'block' . DS . 'components' . DS . 'GetBlocks' . DS);
Yii::setPathOfAlias('helper_view', dirname(__FILE__) . DS . '..' . DS . 'modules' . DS . 'system' . DS);
Yii::setPathOfAlias('file_uploader', dirname(__FILE__) . DS . '..' . DS . 'modules' . DS . 'file' . DS . 'widgets');

$config = [
	'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
	'name' => 'My Site',
	'sourceLanguage' => 'en_EN',
	'language' => 'en',
	//'language' => 'ru',
	'theme' => 'admin',
	'aliases' => [
		'bootstrap' => 'ext.bootstrap',
	],
	//Автозагрузка классов
	'import' => [
		'application.models.*',
		'application.components.*',
		'helper_view.components.*',
		'bootstrap.behaviors.*',
		'bootstrap.helpers.*',
		'bootstrap.widgets.*',
		'application.modules.settings.models.Settings',
		
		'application.modules.user.components.*',
		'application.modules.user.models.*',
		'application.modules.email.components.Email',
		'application.modules.seo.components.SeoHelper',
		
		//Для тестов
		//'application.modules.settings.models.*',
		'application.modules.settings.components.*',
		
	],
	//'defaultController'=>'site',
	//'preload'=>array('log'),
	
	'modules' => [
		'gii' => [
			'class' => 'system.gii.GiiModule',
			'password' => 'wardraft',
			'generatorPaths' => [
				'application.gii',
			],
			'ipFilters' => ['127.0.0.1', '::1'],
		],
		'settings',
		'user',
		'email',
		'file',
		'news',
		'page',
		'block',
		'helper',
                'info',
    ],
	//Конфигурация компонентов приложения
	'components' => [
		'user' => [
			'class'=>'WebUser',
			'allowAutoLogin' => true,
			'loginUrl' => ['/user/auth/login'],
		],
		'authManager' => [
		    'class' => 'AuthManager',
		    'defaultRoles' => array('guest'),
		],
		
		'cFile'=>[
        	'class'=>'application.modules.file.components.CFile',
    	],
		
		'db'=>require_once('db.php'),
		
		//Все скрипты добавляем перед закрытием body
		'clientScript' => [
			'coreScriptPosition' => CClientScript::POS_END,
			'defaultScriptPosition' => CClientScript::POS_END,
			'defaultScriptFilePosition' => CClientScript::POS_END,
			'scriptMap' => [],
			'packages' => require_once( 'packages.php'),
		],
		//Автообновление assets
		'assetManager'=>[
			'forceCopy'=>DEV_MODE,
		],
		'errorHandler' => [
			'errorAction' => 'site/error',
		],
		
		'urlManager' => require_once( 'url_manager.php'),
		/*'log' => array(
			'class' => 'CLogRouter',
			'routes' => array(
				array(
					'class' => 'CFileLogRoute',
					'levels' => 'error, warning',
				),
			// uncomment the following to show log messages on web pages
			/*
			  array(
			  'class'=>'CWebLogRoute',
			  ),
			 
			),
		),
		 * 
		 */
		'cache'=>array(
			'class'=>'CFileCache',
		),
		'memCache'=>array(
	        'class'=>'CFileCache',
	    ),
		'fileCache'=>array(
	        'class'=>'CFileCache',
	    ),
	],
	'params' => require(dirname(__FILE__) .DS. 'params.php'),
];

if (DEV_MODE == true) {
	$config['components']['cache'] = array('class' => 'CDummyCache');
	$config['components']['memCache'] = array('class' => 'CDummyCache');
	$config['components']['fileCache'] = array('class' => 'CDummyCache');
}
return $config;