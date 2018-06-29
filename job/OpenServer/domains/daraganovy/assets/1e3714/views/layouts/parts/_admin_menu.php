<?php

$this->widget('application.modules.admin.components.AdminMenu', [
	'htmlOptions' => ['class' => 'sidebar-nav'],
	'encodeLabel' => false,
	'activateParents' => true,
	'items' => [
		array(
			'label' => 'Home',
			'url' => ['/site/index'],
			'icon' => 'gi gi-home',
		),
		array(
			'label' => Yii::t('admin', 'Site pages'),
			'url' => ['/page/view/admin'],
			'icon' => 'fa fa-file-text-o',
		),
		
		array(
			'label' => Yii::t('main', 'Слайдер'), 
			'url' => ['/slider/front/admin'], 
			'linkOptions' => ['class' => 'sidebar-nav-menu'],
			'icon' => 'gi gi-cogwheels',
			'items' => array(
                            [
                                'label' => Yii::t('main', 'Управление слайдером'), 
                                'url' => ['/slider/front/admin'], 
                                'icon'=>'gi gi-list',
                            ],
                            [
                                'label' => Yii::t('admin', 'Добавить новый слайд'),
                                'url' => ['/slider/front/create'],
                                'icon'=> 'fa fa-plus',
                            ],
			)
		),	
		array(
			'label' => Yii::t('admin', 'Отзывы'), 
			'url' => ['/opinion/view/admin'], 
			'linkOptions' => ['class' => 'sidebar-nav-menu'],
			'icon' => 'gi gi-cogwheels',
			'items' => array(
							[
								'label' => Yii::t('main',  'Управление отзывами'), 
								'url' => ['/opinion/view/admin'], 
								'icon'=>'gi gi-list',
							],
							[
								'label' => Yii::t('admin', 'Добавить новый отзыв'),
								'url' => ['/opinion/view/create'],
								'icon'=> 'fa fa-plus',
							],
			)
		),
		array(
			'label' => Yii::t('admin', 'Блог'), 
			'url' => ['/blog/view/admin'], 
			'linkOptions' => ['class' => 'sidebar-nav-menu'],
			'icon' => 'gi gi-cogwheels',
			'items' => array(
							[
								'label' => Yii::t('main',  'Управление блогом'), 
								'url' => ['/blog/view/admin'], 
								'icon'=>'gi gi-list',
							],
							[
								'label' => Yii::t('admin', 'Добавить новый блог'),
								'url' => ['/blog/view/create'],
								'icon'=> 'fa fa-plus',
							],
			)                        
		),
		array(
			'label' => Yii::t('admin', 'Портфолио'), 
			'url' => ['/portfolio/view/admin'], 
			'linkOptions' => ['class' => 'sidebar-nav-menu'],
			'icon' => 'gi gi-cogwheels',
			'items' => array(
							[
								'label' => Yii::t('main',  'Управление портфолио'), 
								'url' => ['/portfolio/view/admin'], 
								'icon'=>'gi gi-list',
							],
							[
								'label' => Yii::t('admin', 'Добавить в портфолио'),
								'url' => ['/portfolio/view/create'],
								'icon'=> 'fa fa-plus',
							],
			)      	                        
		),
		array(
			'label' => 'Site Settings',
			'url' => ['/settings/settings/admin'],
			'linkOptions' => ['class' => 'sidebar-nav-menu'],
			'icon'=>'gi gi-cogwheels',
			'items' => array(
				[
					'label' => 'Manage Settings',
					'url' => ['/settings/settings/admin'],
					'icon'=>'gi gi-list',
				],
				[
					'label' => 'Add Settings',
					'url' => ['/settings/settings/create'],
					'icon'=>'gi gi-circle_plus',
					'visible'=>Yii::app()->user->checkAccess('developer'),
				],
				[
					'label' => Yii::t('admin', 'Manage Email Messages'), 
					'url' => ['/email/view/admin'], 
					'icon' => 'gi gi-envelope',
					'itemOptions'=>['class'=>'sidebar-separator'],
				],
				[
					'label' => Yii::t('admin', 'Create Email message'),
					'url' => ['/email/view/create'],
					'icon'=>'fa fa-plus-square',
					'visible'=>Yii::app()->user->checkAccess('developer'),
				],
				[
					'label' => Yii::t('admin', 'Manage Email tags'), 
					'url' => ['/email/tag/admin'], 
					'icon' => 'fa fa-tag',
					'visible'=>Yii::app()->user->checkAccess('developer'),
					'itemOptions'=>['class'=>'sidebar-separator'],
				],
				[
					'label' => Yii::t('admin', 'Create Email tag'),
					'url' => ['/email/tag/create'],
					'icon'=> 'fa fa-plus',
					'visible'=>Yii::app()->user->checkAccess('developer'),
				],
				[
					'label' => Yii::t('main', 'Blocks'), 
					'url' => ['/block/default/admin'], 
					'icon' => 'fa fa-list-alt',
					'itemOptions'=>['class'=>'sidebar-separator'],
				],
				[
					'label' => Yii::t('admin', 'Add new block'),
					'url' => ['/block/default/create'],
					'icon'=> 'fa fa-plus',
				],
				[
					'label' => Yii::t('main', 'Тэги'), 
					'url' => ['/portfolio/view/adminTags'], 
					'icon' => 'fa fa-list-alt',
					'itemOptions'=>['class'=>'sidebar-separator'],
				],
				
			)
		),
	],
]);

