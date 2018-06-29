<?php

$this->widget('zii.widgets.CMenu', array(
	'items' => array(
		['label' => 'Главная', 'url' => ['/site/index']],
		['label' => 'Продукты и решения', 'url' => ['/user/auth/login'], 'visible' => Yii::app()->user->isGuest],
		['label' => 'Почему выбирают нас?', 'url' => ['/user/auth/registration'], 'visible' => Yii::app()->user->isGuest],
		['label' => 'Контакты', 'url' => ['/user/view/profile'], 'visible' => Yii::app()->user->isGuest],
		
	),
	'htmlOptions'=>['class'=>'menu', 'id'=>$id],
));
