<?php

return [
	'urlFormat' => 'path',
	'showScriptName' => false,
	'rules' => [
		
		//Главная страница
		'/' => 'site/index',
		'products'=> 'product/view/index',
		'contacts' => 'site/contact',
		//Модуль page
		'page/<url>' => 'page/view/view',
		//Модуль user
		'login' => 'user/auth/login',
		'logout' => 'user/auth/logout',
		'registration' => 'user/auth/registration',
		'profile/<id:\d+>' => 'user/view/profile',
		'profile' => 'user/view/profile',
		'users' => 'user/view/index',
		'user/view/<id:\d+>' => 'user/user/view',

		//Общие url
		'<controller:\w+>/<id:\d+>'=>'<controller>/view',
		'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
		'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
		'<module:\w+>/<controller:\w+>/<action:>/<id:\d+>'=>'<module>/<controller>/<action>',
		'<module:\w+>/<controller:\w+>/<action>'=>'<module>/<controller>/<action>',
	],
];

