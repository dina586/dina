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
            	array('label' => Yii::t('admin', 'Manage site settings'), 'url' => array('/helper/settings/admin'), 'icon'=>BsHtml::GLYPHICON_COG),
			),
        ),
       
        
    )
));
?>