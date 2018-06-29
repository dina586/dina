<?php

return [
	'urlFormat' => 'path',
	'showScriptName' => false,
	'rules' => [
		
		//Главная страница
		'/' => 'site/index',
		'contacts' => 'site/contact',		
        'blog'=>'blog/view/index',
        'opinions'=>'opinion/view/index',
		'<type:photo|video>'=>'portfolio/view/index',
		//Модуль user
		'login' => 'user/auth/login',
		'logout' => 'user/auth/logout',
		'registration' => 'user/auth/registration',
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

