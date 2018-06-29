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
                    'label' => Yii::t('admin', 'Hello').', '.Yii::app()->user->login.'!',
                    'url' => array('/user/profile'),
                    'items' => array(
                        array('label' => Yii::t('admin', 'Change your password'), 'url' => array('/user/view/changePassword'), 'icon' => BsHtml::GLYPHICON_PAPERCLIP),
                        array('label' => Yii::t('admin', 'Your profile'), 'url' => array('/user/view/profile'), 'icon' => BsHtml::GLYPHICON_USER),
                        
                    )
                ),
            	array(
            		'label' => Yii::t('admin', 'Админка'),
            		'url' => array('/user/view/profile'),
            	),
            	
            	array(
            		'label' => Yii::t('admin', 'Настройки сайта'),
            		'url' => array('/admin'),
            		'items' => array(
            			array('label' => Yii::t('main', 'Статические страницы'), 'url' => array('/page/view/admin'), 'icon'=>BsHtml::GLYPHICON_LIST),
            			array('label' => Yii::t('main', 'Блоки'), 'url' => array('/block/default/admin'), 'icon'=>BsHtml::GLYPHICON_LIST),
            			array('label' => Yii::t('admin', 'Настройки сайта'), 'url' => array('/settings/settings/admin'), 'icon'=>BsHtml::GLYPHICON_COG),
            			array('label' => Yii::t('main', 'Слайдер'), 'url' => array('/slider/view/admin'), 'icon'=>BsHtml::GLYPHICON_LIST),
            			array('label' => Yii::t('main', 'Добавить изображение'), 'url' => array('/slider/view/create'), 'icon'=>BsHtml::GLYPHICON_PLUS_SIGN),
            		),
            	),
				array(
            		'label' => Yii::t('admin', 'Отзывы'),
            		'url' => array('/opinion/view/admin'),
            		'items' => array(
            			array('label' => Yii::t('main', 'Create'), 'url' => array('/opinion/view/create'), 'icon'=>BsHtml::GLYPHICON_PLUS_SIGN),
            			array('label' => Yii::t('main', 'Manage'), 'url' => array('/opinion/view/admin'), 'icon'=>BsHtml::GLYPHICON_LIST),
            		),
            	),
				array(
            		'label' => Yii::t('admin', 'Наши работы'),
            		'url' => array('/objects/view/admin'),
            		'items' => array(
            			array('label' => Yii::t('main', 'Добавить'), 'url' => array('/objects/view/create'), 'icon'=>BsHtml::GLYPHICON_PLUS_SIGN),
            			array('label' => Yii::t('main', 'Наши работы'), 'url' => array('/objects/view/admin'), 'icon'=>BsHtml::GLYPHICON_LIST),
            		),
            	),
				array(
            		'label' => Yii::t('admin', 'Блок-схема'),
            		'url' => array('/design/view/admin'),
            		'items' => array(
            			array('label' => Yii::t('main', 'Добавить'), 'url' => array('/design/view/create'), 'icon'=>BsHtml::GLYPHICON_PLUS_SIGN),
            			array('label' => Yii::t('main', 'Список'), 'url' => array('/design/view/admin'), 'icon'=>BsHtml::GLYPHICON_LIST),
            		),
            	),
				array(
            		'label' => Yii::t('admin', 'Загрузка сертификатов'),
            		'url' => array('/helper/default/cerf'),
            		'items' => array(
            			array('label' => Yii::t('main', 'Сертификаты'), 'url' => array('/helper/default/cerf'), 'icon'=>BsHtml::GLYPHICON_LIST),
            			array('label' => Yii::t('main', 'Обучение'), 'url' => array('/helper/default/teach'), 'icon'=>BsHtml::GLYPHICON_LIST),
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
                        '/user/auth/logout'
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
