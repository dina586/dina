<?php
define('DS', DIRECTORY_SEPARATOR);
Yii::setPathOfAlias('helper_view', dirname(__FILE__).DS.'..'.DS.'modules'.DS.'helper'.DS);

// uncomment the following to define a path alias
//Yii::setPathOfAlias('YiiDebug','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Орхидеи',
	'sourceLanguage'=>'ru_RU',
	'language' => 'ru',
    	'aliases' => array(
		'bootstrap' => 'ext.bootstrap',
	),
	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.modules.shop.models.*',
		'application.modules.block.models.*',
		'application.modules.stock.models.*',
		'application.modules.content.models.*',
		'application.modules.helper.components.System',
                'application.modules.helper.components.Fields',
		'application.components.*',
		'ext.shoppingCart.*',
            	'bootstrap.behaviors.*',
		'bootstrap.helpers.*',
            	'bootstrap.widgets.*',
	),

	'modules'=>array(
		'shop',
		'content',
		'block',
		'gallery',
		'email',
		'stock',
		'clients',
        'helper',
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'wardraft',
		 	// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		'cFile'=>array(
        	'class'=>'application.extensions.file.CFile',
    	),
    	'shoppingCart' => array(
			'class' => 'ext.shoppingCart.EShoppingCart',
		),
		// uncomment the following to enable URLs in path-format
		
		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName'=>false,
			'rules'=>array(
				/*Shop URLs rules*/
				'shop/catalog/name/<c_name>'=>'shop/catalog/name',
				'shop/<controller>/<action>/<id:\d+>'=>'shop/<controller>/<action>',
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		/**/
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=orxby_orx',
			'emulatePrepare' => true,
			'username' => 'orxby_root',
			'password' => 'TE9SQlok5D({',
			'charset' => 'utf8',
			'tablePrefix' => 'tbl_',
			//'enableProfiling'=>true, //Отключить при рабочем режиме
		),
		
		
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=orxby_orx',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
			'tablePrefix' => 'tbl_',
			//'enableProfiling'=>true, //Отключить при рабочем режиме
		),
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
            'errorAction'=>'site/error',
        ),
		'widgetFactory'=>array(
            'widgets'=>array(
                'CLinkPager'=>array(
                    'maxButtonCount'=>8,
    				'header'=>false,
					'prevPageLabel'=>'Предыдущая',
					'nextPageLabel'=>'Следующая',
    				'firstPageLabel'=>'<<',
 					'lastPageLabel'=>'>>',
                ),
			),
        ),
        'clientScript' => array(
			'packages' => array(
				'dropdownmenu' => array(
					'basePath' => 'webroot.lib.dropdownmenu',
					'js' => array(
						'jqueryslidemenu.js',
        			),
        			'css' => array(
        				'jqueryslidemenu.css',
        			),
        		),
				'countdown'=>array(
					'basePath'=>'webroot.packages.countdown',
					'js' => array('jquery.countdown.js', 'jquery.countdown-ru.js'),
					'depends' => array('jquery'),
				),
        	),
        ),
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
);