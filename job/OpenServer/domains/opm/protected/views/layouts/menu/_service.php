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
                    'label' => 'Manage Services',
                    'url' => array(
                        '/service/view/admin'
                    ),
                ),
            	array(
            		'label' => 'Create new Service',
            		'url' => array(
            			'/service/view/create'
            		),
            	),
                array(
                    'label' => 'Manage Procedures',
                    'url' => array(
                        '/service/procedure/admin'
                    ),
                ),
            	array(
            		'label' => 'Create new Procedure',
            		'url' => array(
            			'/service/procedure/create'
            		),
            	)
            ),
        ),
    )
));
?>