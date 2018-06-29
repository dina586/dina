<?php
$this->widget('bootstrap.widgets.BsModal', array(
    'id' => 'j-get_order_dialog',
    'header' => Yii::t('admin', 'Записаться на консультацию'),
    'content' => Yii::app()->controller->renderPartial('application.widgets.views.order_form._form', array('model'=>$model), true),
	'footer'=>false,
));

Yii::app()->controller->renderPartial('application.widgets.views._message');
?>
