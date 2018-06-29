<?php
$this->widget('bootstrap.widgets.BsModal', array(
    'id' => 'j-get_call_dialog',
    'header' => Yii::t('admin', 'Get a Call'),
    'content' => Yii::app()->controller->renderPartial('application.widgets.views.call_form._form', array('model'=>$model), true),
	'footer'=>false,
));

Yii::app()->controller->renderPartial('application.widgets.views._message');
?>
