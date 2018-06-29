<?php
$this->widget('bootstrap.widgets.BsModal', array(
    'id' => 'j-get_extra_dialog',
    'header' => Yii::t('admin', ' оставить заявку '),
    'content' => Yii::app()->controller->renderPartial('application.widgets.views.extra_form._form', array('model'=>$model), true),
	'footer'=>false,
));
?>

