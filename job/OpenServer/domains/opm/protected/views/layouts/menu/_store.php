<?php
$this->widget('bootstrap.widgets.BsNavbar', array(
    'collapse' => true,
    'brandLabel' => false,
    'brandUrl' => false,
	'color'=>BsHtml::NAVBAR_COLOR_INVERSE,
    'items' => array(
        array(
            'class' => 'bootstrap.widgets.BsNav',
            'type' => 'navbar',
            'activateParents' => true,
            'items' => array(
            	array('label' => Yii::t('admin', 'Add product'), 'url' => array('/store/product/create'), 'icon'=>BsHtml::GLYPHICON_PLUS_SIGN),
            	array('label' => Yii::t('admin', 'Manage products'), 'url' => array('/store/product/admin'), 'icon'=>BsHtml::GLYPHICON_LIST),
            	array('label' => Yii::t('admin', 'Add catalog'), 'url' => array('/store/catalog/create'), 'icon'=>BsHtml::GLYPHICON_PLUS),
            	array('label' => Yii::t('admin', 'Manage catalogs'), 'url' => array('/store/catalog/admin'), 'icon'=>BsHtml::GLYPHICON_LIST_ALT),
            	array('label' => 'Purchase history', 'url' => array('/store/history/admin'), 'icon'=>BsHtml::GLYPHICON_SHOPPING_CART),
            	array(
            		'label' => 'Shipping',
            		'url' => array('/store/delivery/admin'), 
            		'icon'=>BsHtml::GLYPHICON_GLOBE,
            		'items' => array(
            			array('label' => Yii::t('admin', 'Add Shipping'), 'url' => array('/store/delivery/create'), 'icon'=>BsHtml::GLYPHICON_PLUS_SIGN),
            			array('label' => Yii::t('admin', 'Manage Shippings'), 'url' => array('/store/delivery/admin'), 'icon'=>BsHtml::GLYPHICON_LIST),
            		),
            	),
            ),
        ),
       
        
    )
));
?>