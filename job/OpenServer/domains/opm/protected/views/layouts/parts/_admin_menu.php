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
                        
                    )
                ),
            	array(
            		'label' => Yii::t('admin', 'Crm'),
            		'url' => array('/site/index'),
            	),
            	array(
            		'label' => Yii::t('admin', 'Services'),
            		'url' => array('/service/view/admin'),
            			'items' => array(
            				array('label' => Yii::t('main', 'Create service'), 'url' => array('/service/view/create'), 'icon'=>BsHtml::GLYPHICON_PLUS_SIGN),
            				array('label' => Yii::t('main', 'Manage services'), 'url' => array('/service/view/admin'), 'icon'=>BsHtml::GLYPHICON_LIST),
            				array('label' => Yii::t('admin', 'Add procedure'), 'url' => array('/service/procedure/create'), 'icon'=>BsHtml::GLYPHICON_PLUS),
            				array('label' => Yii::t('admin', 'Manage procedures'), 'url' => array('/service/procedure/admin'), 'icon'=>BsHtml::GLYPHICON_LIST_ALT),
            				array('label' => Yii::t('admin', 'Add gallery'), 'url' => array('/service/gallery/create'), 'icon'=>BsHtml::GLYPHICON_PLUS),
            				array('label' => Yii::t('admin', 'Manage galleries'), 'url' => array('/service/gallery/admin'), 'icon'=>BsHtml::GLYPHICON_LIST_ALT),
            			),
            	),
				array(
					'label' => Yii::t('admin', 'Manage Store').' '.ProdHistory::getNewOrders(),
					'url' => array('/shop/product/admin'),
					'items' => array(
            			array('label' => Yii::t('admin', 'Add product'), 'url' => array('/store/product/create'), 'icon'=>BsHtml::GLYPHICON_PLUS_SIGN),
            			array('label' => Yii::t('admin', 'Manage products'), 'url' => array('/store/product/admin'), 'icon'=>BsHtml::GLYPHICON_LIST),
            			array('label' => Yii::t('admin', 'Add catalog'), 'url' => array('/store/catalog/create'), 'icon'=>BsHtml::GLYPHICON_PLUS),
            			array('label' => Yii::t('admin', 'Manage catalogs'), 'url' => array('/store/catalog/admin'), 'icon'=>BsHtml::GLYPHICON_LIST_ALT),
            			array('label' => 'StoreHistory'.' '.ProdHistory::getNewOrders(), 'url' => array('/store/history/admin'), 'icon'=>BsHtml::GLYPHICON_SHOPPING_CART),
            		),
            	),	
            	array(
            		'label' => Yii::t('admin', 'Clients'),
            		'url' => array('/user/admin/admin'),
            		'items' => array(
            			array('label' => Yii::t('admin', 'Add new client'), 'url' => array('/user/admin/create'), 'icon'=>BsHtml::GLYPHICON_PLUS_SIGN),
                        array('label' => Yii::t('admin', 'Manage client'), 'url' => array('/user/admin/admin'), 'icon'=>BsHtml::GLYPHICON_LIST),
            		),
            	),
            	array(
            		'label' => Yii::t('admin', 'Video'),
            		'url' => array('/video/admin/admin'),
            		'items' => array(
            			array('label' => Yii::t('admin', 'Add new video'), 'url' => array('/video/view/create'), 'icon'=>BsHtml::GLYPHICON_PLUS_SIGN),
                        array('label' => Yii::t('admin', 'Manage video'), 'url' => array('/video/view/admin'), 'icon'=>BsHtml::GLYPHICON_LIST),
            		),
            	),
            	array(
            		'label' => Yii::t('admin', 'Site'),
            		'url' => array('/admin'),
            		'items' => array(
            			array('label' => Yii::t('main', 'Pages'), 'url' => array('/page/view/admin'), 'icon'=>BsHtml::GLYPHICON_LIST),
            			array('label' => Yii::t('main', 'Blocks'), 'url' => array('/block/default/admin'), 'icon'=>BsHtml::GLYPHICON_LIST),
            			array('label' => Yii::t('admin', 'Manage site settings'), 'url' => array('/helper/settings/admin'), 'icon'=>BsHtml::GLYPHICON_COG),
            			array('label' => Yii::t('main', 'Big Slider'), 'url' => array('/slider/front/admin'), 'icon'=>BsHtml::GLYPHICON_LIST),
            			array('label' => Yii::t('main', 'Trade Shows'), 'url' => array('/trade/view/admin'), 'icon'=>BsHtml::GLYPHICON_LIST),
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
