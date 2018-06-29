<?php
return array(
	/**
	 * Роли
	 */
    'guest' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Guest',
        'bizRule' => null,
        'data' => null
    ),
    //Базовая роль всех пользователей по умолчанию, от неё наследуются все остальные роли и операции на сайте
    'user' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Client',
        'children' => array(
            'guest', 
        ),
        'bizRule' => null,
        'data' => null
    ),
    //Самый толстый и длинный
    'admin' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Administrator',
        'children' => array(
            'user',        
        ),
        'bizRule' => null,
        'data' => null
    ),
	'developer' => array(
        'type' => CAuthItem::TYPE_ROLE,
        'description' => 'Developer',
        'children' => array(
            'admin',        
        ),
        'bizRule' => null,
        'data' => null
    ),
	
);