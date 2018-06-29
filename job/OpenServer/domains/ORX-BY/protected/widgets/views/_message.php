<?php
$this->widget('bootstrap.widgets.BsModal', array(
	'id' => 'j-message_dialog',
	'header' => Yii::t('admin', "Статус отправки"),
	'content' => Yii::t('admin', "Your message successfully sent! We contact you as soon as possible!"),
	'footer' => false,
));
?>