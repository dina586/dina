<?php

$this->widget('zii.widgets.CMenu', array(
	'items' => array(
		['label' => 'Главная', 'url' => ['/site/index']],
		['label' => 'Продукты и решения', 'url' => ['/product']],
		['label' => 'Почему выбирают нас?', 'url' => ['/page/view/view', 'url'=>'about-us']],
		['label' => 'Контакты', 'url' => ['/contacts']],
		
	),
	'htmlOptions'=>['class'=>'menu', 'id'=>$id],
));
