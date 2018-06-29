<?php
define('DS', DIRECTORY_SEPARATOR);
// uncomment the following to define a path alias
Yii::setPathOfAlias('block_view', dirname(__FILE__).DS.'..'.DS.'modules'.DS.'block'.DS.'components'.DS.'GetBlocks'.DS);
Yii::setPathOfAlias('helper_view', dirname(__FILE__).DS.'..'.DS.'modules'.DS.'helper'.DS);
Yii::setPathOfAlias('file_uploader', dirname(__FILE__).DS.'..'.DS.'modules'.DS.'file'.DS.'widgets');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
$config = array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Site',
	'sourceLanguage'=>'en_EN',
	'language' => 'en',
	'theme' => 'crm',
	//'language' => 'ru',

	// preloading 'log' component
	//'preload'=>array('log'),
		
	'aliases' => array(
		'bootstrap' => 'ext.bootstrap',
	),
		
	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.components.behavior.*',
		'application.modules.store.components.shoppingCart.*',
		'application.modules.user.models.*',
        'application.modules.user.components.*',
		'application.modules.roles.models.*',
		'application.modules.search.components.Search',
		'application.modules.helper.models.Settings',
		'application.modules.store.components.*',
		'application.modules.store.models.*',
		'helper_view.components.*',
		'bootstrap.behaviors.*',
		'bootstrap.helpers.*',
		'bootstrap.widgets.*',
		
		/*
		'ext.social-network.eoauth.*',
        'ext.social-network.eoauth.lib.*',
        'ext.social-network.lightopenid.*',
        'ext.social-network.eauth.*',
        'ext.social-network.eauth.services.*',
         */
	),

	'modules'=>array(
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'wardraft',
			'generatorPaths'=>array(
                'application.gii',   // псевдоним пути
            ),
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		'user'=>array(
			'hash' => 'md5',                                     # encrypting method (php hash function)
			'sendActivationMail' => true,                        # send activation email
			'loginNotActiv' => false,                            # allow access for non-activated users
			'activeAfterRegister' => false,                      # activate user on registration (only sendActivationMail = false)
			'autoLogin' => true,                                 # automatically login from registration
			'registrationUrl' => array('/user/registration'),    # registration path
			'recoveryUrl' => array('/user/recovery'),            # recovery password path
			'loginUrl' => array('/user/login'),                  # login form path
			'returnUrl' => array('/user/profile'),               # page after login
			'returnLogoutUrl' => array('/user/login'),           # page after logout
        ),
        'helper',
        'block'=>array(
        	'namespace'=>array(
        		'confirm_page'=>Yii::t('admin', 'Payment confirm page'),
        		'header'=>Yii::t('admin', 'Header'),
        		'footer'=>Yii::t('admin', 'Footer'),
        		'service_block'=>Yii::t('admin', 'Service top block'),
        	),
        ),
		'roles',
        'page',
        'service',
  		'file',
		'email',
		'store',
		'invoice',
		'excel',
		'video',
		'calendar',
		'slider',
		'trade',
		'search',
	),
	
	// application components
	'components'=>array(
		
		'widgetFactory'=>array(
            'widgets'=>array(
                'CLinkPager'=>array(
                    'maxButtonCount'=>8,
                    'cssFile'=>false,
    				'header'=>false,
					'prevPageLabel'=>Yii::t('admin', 'previous'),
					'nextPageLabel'=>Yii::t('admin', 'next'),
    				'firstPageLabel'=>'<<',
 					'lastPageLabel'=>'>>',
                ),
                'CJuiDatePicker'=>array(
                    'language'=>'en',
                	'options'=>array(
				        'showAnim'=>'fold',
						'dateFormat'=>'mm/dd/yy',
						'constrainInput'=> true,
				    ),
                ),
                'CJuiDateTimePicker'=>array(
                    'language'=>'',
                	'options'=>array(
				        'showAnim'=>'fold',
				        'type'=>'datetime',
						"dateFormat"=>'mm/dd/yy',
						"timeFormat"=>"hh:mm tt",
						"minuteGrid"=>"10",
						'constrainInput'=> true,
				    ),
                ),
                'jqueryDateTime'=>array(
                	'options'=>array(
						"format"=>'m/d/Y h:i a',
						'formatTime'=> 'h:i A',
						'step'=>15,
						//'defaultHours'=>0,
						//'defaultMinutes'=>0,
						//'minDate'=>0,
				    ),
                ),

                'CListView'=>array(
                	'ajaxUpdate'=> false,
                	'template'=>"{items}{pager}",
					'emptyText'=>'<article class = "g-styles"><p>'.Yii::t('admin', 'No data found').'</p></article>',
                ),
                'BsListView'=>array(
                	'ajaxUpdate'=> false,
                	'template'=>"{items}{pager}",
					'emptyText'=>'<article class = "g-styles"><p>'.Yii::t('admin', 'No data found').'</p></article>',
                ),
                'CDetailView'=>array(
                	'htmlOptions'=>array('class'=>'detail-view l-detail-view'),
                	'cssFile' => false,
                ),
                'CGridView'=>array(
                	'template' => '{items}{pager}',
                	'cssFile' => false,
                ),
                'BsGridView'=>array(
                	'template' => '{summary}{items}{pager}',
                	'cssFile' => false,
                ),
			),
        ),
        'loid' => array(
            'class' => 'ext.social-network.lightopenid.loid',
        ),
		'user'=>array(
        	'class'=>'WebUser',
            'allowAutoLogin'=>true,
            'loginUrl' => array('/user/login'),
		),
		
		'authManager' => array(
		    'class' => 'AuthManager',
		    'defaultRoles' => array('guest'),
		),
		'cFile'=>array(
        	'class'=>'application.modules.file.components.CFile',
    	),
		'yandex'=>array(
        	'class'=>'ext.payment.yandex.YandexMoney',
    	),
    	'shoppingCart' => array(
    		'class' => 'application.modules.store.components.shoppingCart.EShoppingCart',
    	),
    	'bootstrap' => array(
    		'class' => 'bootstrap.components.BsApi'
    	),
		'clientScript' => array(
	        'scriptMap' => array(
	        ),
	        'packages'=>require_once('packages.php'),
        ),
        'eauth' => array(
	        'class' => 'ext.social-network.eauth.EAuth',
	        'popup' => false, 
	        'cache' => false, 
	        'cacheExpire' => 0, // Cache lifetime. Defaults to 0 - means unlimited.
        ),
        'ePdf' => array(
        	'class'         => 'ext.yii-pdf.EYiiPdf',
        	'params'        => array(
        	'mpdf'     => array(
        		'librarySourcePath' => 'application.vendors.mpdf.*',
        		'constants'	=> array(
	        		'_MPDF_TEMP_PATH' => Yii::getPathOfAlias('application.runtime'),
	        	),
				'class'=>'mpdf', // Для некоторых "регистрочувствительных" систем
        		'defaultParams'	=> array( 
        			// Детальней: http://mpdf1.com/manual/index.php?tid=184
        								// 'mode'              => '', //  This parameter specifies the mode of the new document.
 					'format'            => 'A4', // format A4, A5, ...
        								/*'default_font_size' => 0, // Sets the default document font size in points (pt)
        								 'default_font'      => '', // Sets the default font-family for the new document.
        'mgl'               => 15, // margin_left. Sets the page margins for the new document.
        'mgr'               => 15, // margin_right
        'mgt'               => 16, // margin_top
        'mgb'               => 16, // margin_bottom
        'mgh'               => 9, // margin_header
        'mgf'               => 9, // margin_footer
        'orientation'       => 'P', // landscape or portrait orientation
        */		
	        		),
	        	),
			),
        ),
        
		// uncomment the following to enable URLs in path-format
		
		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName'=>false,
			'rules'=>array(
        		'/'=>'site/front',
        		//'site/front'=>'store/product/index',
        		'/admin'=>'site/index',
        		'services' => 'service/view/index',
        		'video' => 'video/view/index',
        		'news' => 'news/view/index',
        		'gallery' => 'service/gallery/index',
        		'admin-calendar' => 'calendar/view/index',
        		'calendar/<id>' => 'calendar/site/index',
        		'calendar' => 'calendar/site/index',
        		'trade' => 'trade/view/index',
				'contacts' => 'site/contact',
				'site/quick/<type:\d+>' => 'site/quick',
				
				//Модуль user
				'user/view/<id:\d+>'=>'user/user/view',
				'video/view/update/<id:\d+>'=>'video/view/update',
        		
				'<module>/<controller:\w+>/<action:create|admin|seo|index>'=>'<module>/<controller>/<action>',
				//'service/<controller:user>/<action:\w+>'=>'service/<controller>/<action>',
				'service/view/contract'=>'service/view/contract',
				'store/<controller:cart|history>/<action:\w+>'=>'store/<controller>/<action>',
				'store/catalog/index'=>'store/catalog/index',
				/*Восстановление работы url*/
				'<module>/<controller:\w+>/<action:create|admin|seo>'=>'<module>/<controller>/<action>',
				'<module>/<controller:\w+>/<action:update|delete|upload>/<id:\d+>'=>'<module>/<controller>/<action>',
				//'<module>/<controller:cart>/<action:\w+>'=>'<module>/<controller>/<action>',
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
				/*Module urls*/
        		'<module:store|service>/<controller:product|catalog|gallery>/<url>'=>'<module>/<controller>/view',
				'<module:page|service|trade>/<controller:view>/<url>'=>'<module>/<controller>/view',
				'<module:\w+>/<controller:\w+>/<action:\w+>/<id:\d+>'=>'<module>/<controller>/<action>',
			),
		),
		
		'db'=>require_once('db.php'),
		
		/*'cache'=>array(
			//'class'=>'CMemCache',
			//'class'=>'CDummyCache',
			//'class'=>'CDbCache',
			'class'=>'CFileCache',
		),
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
			
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
	
	),
	
	// using Yii::app()->params['paramName']
	'params'=>require_once('params.php'),

);

if(DEV_MODE == true) {
	/*$config['components']['log'] = array(
			'class'=>'CLogRouter',
			'routes'=>array(
					array(
							'class'=>'CProfileLogRoute',
							'report'=>'summary',
					),
					array(
							'class'=>'CWebLogRoute',
					),
			)
	);*/
	$config['components']['cache']= array('class'=>'CDummyCache');
	$config['components']['memCache']= array('class'=>'CDummyCache');
	$config['components']['fileCache']= array('class'=>'CDummyCache');
}

return $config;