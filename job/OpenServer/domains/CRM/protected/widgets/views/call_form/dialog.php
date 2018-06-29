<?php
$this->widget('bootstrap.widgets.BsModal', array(
    'id' => 'j-get_call_dialog',
    'header' => Yii::t('admin', 'Заявка'),
    'content' => Yii::app()->controller->renderPartial('application.widgets.views.call_form._form', array('model'=>$model, 'id'=>'b-call_form', 'class'=>'a-get_call'), true),
	'footer'=>false,
));
Yii::app()->controller->renderPartial('application.widgets.views._message');

?>


