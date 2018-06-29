<?php

$this->widget('application.modules.admin.components.AdminMenu', [
	'htmlOptions' => ['class' => 'sidebar-nav'],
	'encodeLabel' => false,
	'activateParents' => true,
	'items' => [
		array(
			'label' => 'Home',
			'url' => ['/site/index']
		),
		array(
			'label' => 'Site Settings',
			'url' => ['/system/settings/admin'],
			'linkOptions' => ['class' => 'sidebar-nav-menu'],
			'icon'=>'gi gi-shopping_cart sidebar-nav-icon',
			'items' => array(
				[
					'label' => 'New Arrivals',
					'url' => ['product/new', 'tag' => 'new'],
					'icon'=>'gi gi-shopping_cart sidebar-nav-icon',
				],
				[
					'label' => 'Most Popular',
					'url' => ['product/index', 'tag' => 'popular']
				],
			)
		),
	],
]);

