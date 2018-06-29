<?php
$this->widget('bootstrap.widgets.BsModal', array(
    'id' => 'j-calendar_registration_dialog',
    'header' => Yii::t('admin', 'Service registration'),
	'content' => Yii::app()->controller->renderPartial('application.modules.calendar.widgets.views.registration_form', array('model'=>$model), true),
	'footer'=>false,
	'htmlOptions'=>['class'=>'b-calendar_registration_dialog']
));

Yii::app()->controller->renderPartial('application.widgets.views._message');
?>
