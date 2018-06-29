<?php

/**
 * @author Nicholas Kobets <wemadefoxnever@gmail.com>
 * @copyright 365-solutions.com
 * @license http://365-solutions.com/general-license
 */
return array(
	/**
	 * Роли
	 */
	//Эквивалент гостя
	'guest' => [
		'type' => CAuthItem::TYPE_ROLE,
		'description' => 'Guest',
		'bizRule' => null,
		'data' => null
	],
	//Базовая роль всех пользователей по умолчанию, от неё наследуются все остальные роли и операции на сайте
	'user' => [
		'type' => CAuthItem::TYPE_ROLE,
		'description' => 'User',
		'children' => array(
			'guest',
		),
		'bizRule' => null,
		'data' => null
	],
	//Администратор сайта
	'admin' => [
		'type' => CAuthItem::TYPE_ROLE,
		'description' => 'Administrator',
		'children' => array(
			'user',
		),
		'bizRule' => null,
		'data' => null
	],
	//Разработчик
	'developer' => [
		'type' => CAuthItem::TYPE_ROLE,
		'description' => 'Developer',
		'children' => array(
			'admin',
		),
		'bizRule' => null,
		'data' => null
	],
);
