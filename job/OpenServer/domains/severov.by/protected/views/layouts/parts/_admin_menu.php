<div class = "b-admin_menu">

<?php
$this->widget('bootstrap.widgets.BsNavbar', array(
	'collapse' => true,
    'brandLabel' => BsHtml::icon(BsHtml::GLYPHICON_HOME),
    'brandUrl' => Yii::app()->homeUrl,
	'position' => BsHtml::NAVBAR_POSITION_STATIC_TOP,
    'items' => array(
        array(
            'class' => 'bootstrap.widgets.BsNav',
            'type' => 'navbar',
            'activateParents' => true,
            'items' => array(
                array(
                    'label' => Yii::t('admin', 'Hello').', '.Yii::app()->user->username.'!',
                    'url' => array('/user/profile'),
                    'items' => array(
                        array('label' => Yii::t('admin', 'Change your password'), 'url' => array('/user/profile/changepassword'), 'icon' => BsHtml::GLYPHICON_PAPERCLIP),
                        array('label' => Yii::t('admin', 'Your profile'), 'url' => array('/user/profile'), 'icon' => BsHtml::GLYPHICON_USER),
                        array('label' => Yii::t('admin', 'User Management'), 'url' => array('/user/admin/admin'), 'icon'=>BsHtml::GLYPHICON_COG),
                    )
                ),
            		
            	array(
            		'label' => Yii::t('admin', 'Settings'),
            		'url' => array('/helper/settings/admin'),
            		'items' => array(
            			array('label' => Yii::t('admin', 'Manage site settings'), 'url' => array('/helper/settings/admin'), 'icon'=>BsHtml::GLYPHICON_COG),
            			array('label' => Yii::t('admin', 'Manage Email Messages'), 'url' => array('/email/view/admin'), 'icon'=>BsHtml::GLYPHICON_ENVELOPE),
            			array('label' => Yii::t('admin', 'Manage Email tags'), 'url' => array('/email/tag/admin'), 'icon'=>BsHtml::GLYPHICON_CLOUD, 'visible'=>Yii::app()->user->checkAccess('developer')),
            		),
            	),
            	
            	array(
            		'label' => Yii::t('admin', 'Site pages'),
            		'url' => array('/page/view/admin'),
            	),
            	
            	array(
            		'label' => Yii::t('admin', 'Техники'),
            		'url' => array('/technics/view/admin'),
            		'items' => array(
            			array('label' => Yii::t('main', 'Manage'), 'url' => array('/technics/view/admin'), 'icon'=>BsHtml::GLYPHICON_LIST),
            			array('label' => Yii::t('main', 'Create'), 'url' => array('/technics/view/create'), 'icon'=>BsHtml::GLYPHICON_PLUS_SIGN),
            		),
            	),
            	array(
            		'label' => Yii::t('admin', 'Услуги'),
            		'url' => array('/service/view/admin'),
            		'items' => array(
            			array('label' => Yii::t('main', 'Manage'), 'url' => array('/service/view/admin'), 'icon'=>BsHtml::GLYPHICON_LIST),
            			array('label' => Yii::t('main', 'Create'), 'url' => array('/service/view/create'), 'icon'=>BsHtml::GLYPHICON_PLUS_SIGN),
            		),
            	),
				
				array(
            		'label' => Yii::t('admin', 'Блоги'),
            		'url' => array('/blog/view/admin'),
            		'items' => array(
            			array('label' => Yii::t('main', 'Manage'), 'url' => array('/blog/view/admin'), 'icon'=>BsHtml::GLYPHICON_LIST),
            			array('label' => Yii::t('main', 'Create'), 'url' => array('/blog/view/create'), 'icon'=>BsHtml::GLYPHICON_PLUS_SIGN),
            		),
            	),
				
				array(
            		'label' => Yii::t('admin', 'Статьи'),
            		'url' => array('/article/view/admin'),
            		'items' => array(
            			array('label' => Yii::t('main', 'Manage'), 'url' => array('/article/view/admin'), 'icon'=>BsHtml::GLYPHICON_LIST),
            			array('label' => Yii::t('main', 'Create'), 'url' => array('/article/view/create'), 'icon'=>BsHtml::GLYPHICON_PLUS_SIGN),
            		),
            	),
				
				array(
            		'label' => Yii::t('admin', 'Отзывы'),
            		'url' => array('/opinion/view/admin'),
            		'items' => array(
            			array('label' => Yii::t('main', 'Manage'), 'url' => array('/opinion/view/admin'), 'icon'=>BsHtml::GLYPHICON_LIST),
            			array('label' => Yii::t('main', 'Create'), 'url' => array('/opinion/view/create'), 'icon'=>BsHtml::GLYPHICON_PLUS_SIGN),
            		),
            	),

            	/* Template
            	array(
            		'label' => Yii::t('admin', ''),
            		'url' => array('/admin'),
            		'items' => array(
            			array('label' => Yii::t('main', 'Create'), 'url' => array('/create'), 'icon'=>BsHtml::GLYPHICON_PLUS_SIGN),
            			array('label' => Yii::t('main', 'Manage'), 'url' => array('/admin'), 'icon'=>BsHtml::GLYPHICON_LIST),
            		),
            	),
            	*/
            ),
        ),
        array(
            'class' => 'bootstrap.widgets.BsNav',
            'type' => 'navbar',
            'activateParents' => true,
            'items' => array(
                array(
                    'label' => Yii::t('admin','Logout'),
                    'pull' => BsHtml::NAVBAR_NAV_PULL_RIGHT,
                    'url' => array(
                        '/user/logout'
                    ),
                )
            ),
            'htmlOptions' => array(
                'pull' => BsHtml::NAVBAR_NAV_PULL_RIGHT
            )
        )
        
    ),
));
?>
</div>
