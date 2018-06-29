<?php

return [
	'urlFormat' => 'path',
	'showScriptName' => false,
	'rules' => [
		
		//Главная страница
		'/' => 'site/index',
		'contacts' => 'site/contact',

		//Модуль user
		'product' => 'product/view/index',
		'gallery'=>'gallery/view/index',
		'coupons'=>'coupons/view/index',
		
		'login' => 'user/auth/login',
		'logout' => 'user/auth/logout',
		'registration' => 'user/auth/registration',
		'profile/<id:\d+>' => 'user/view/profile',
		'profile' => 'user/view/profile',
		'users' => 'user/view/index',
        'page' => 'page/view/index',
		'user/view/<id:\d+>' => 'user/user/view',
        'page/<url>' => 'page/view/view',
		
		//Общие url
		'<controller:\w+>/<id:\d+>'=>'<controller>/view',
		'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
		'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
		'<module:\w+>/<controller:\w+>/<action:>/<id:\d+>'=>'<module>/<controller>/<action>',
		'<module:\w+>/<controller:\w+>/<action>'=>'<module>/<controller>/<action>',
	],
];

