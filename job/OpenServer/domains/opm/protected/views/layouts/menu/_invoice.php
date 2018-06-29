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
            	array('label' => Yii::t('admin', 'Create invoice'), 'url' => array('/invoice/view/create'), 'icon'=>BsHtml::GLYPHICON_PLUS_SIGN),
            	array('label' => Yii::t('admin', 'Manage invoice'), 'url' => array('/invoice/view/admin'), 'icon'=>BsHtml::GLYPHICON_LIST),
            ),
        ),
    )
));
?>