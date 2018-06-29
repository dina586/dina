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
                array(
                    'label' => 'Clients List',
                    'url' => array(
                        '/user/admin/admin'
                    ),
                ),
            	array(
            		'label' => 'Register New Client',
            		'url' => array(
            			'/user/admin/create'
            		),
            	),
            	array(
            		'label' => 'Add New Procedure',
            		'url' => array(
            			'/user/procedure/create',
            			'user_id'=>Yii::app()->request->getParam('id'),
            		),
            		'visible'=>Yii::app()->controller->action->id == 'view' && Yii::app()->controller->id == 'admin'
            	),
            ),
        ),
       
        
    )
));
?>