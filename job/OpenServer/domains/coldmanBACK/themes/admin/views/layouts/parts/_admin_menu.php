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
			'visible'=>Yii::app()->user->checkAccess('admin'),
		),
		array(
			'label' => 'Site Settings',
			'url' => ['/settings/settings/admin'],
			'linkOptions' => ['class' => 'sidebar-nav-menu'],
			'icon'=>'gi gi-cogwheels',
			'visible'=>Yii::app()->user->checkAccess('admin'),
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
			)
		),
		array(
			'label' => 'Users',
			'url' => ['/user/view/index'],
			'linkOptions' => Yii::app()->user->checkAccess('admin')?['class' => 'sidebar-nav-menu']:'',
			'icon'=>'fa fa-users',
			'items' => array(
				[
					'label' => 'Manage User',
					'url' => ['/user/admin/manage'],
					'icon'=>'fa fa-list-ol',
					'visible'=>Yii::app()->user->checkAccess('admin'),
				],
				[
					'label' => 'Register new User',
					'url' => ['/user/admin/create'],
					'icon'=>'fa fa-user-plus',
					'visible'=>Yii::app()->user->checkAccess('admin'),
				],
				[
					'label' => 'View users',
					'url' => ['/user/view/index'],
					'icon'=>'gi gi-parents',
					'visible'=>Yii::app()->user->checkAccess('admin'),
				],
			)
		),
	],
]);

