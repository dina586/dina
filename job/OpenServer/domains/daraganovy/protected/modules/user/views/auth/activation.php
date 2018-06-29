<?php

$this->renderPartial('/layouts/message', array('json' => $json));
if ($json['error'] === true) {
	echo Yii::t('admin', 'If You have any problem with your account activation, please, write to {link} or {message}', array(
		'{link}' => BsHtml::mailto(Settings::getVal('site_email')),
		'{message}' => BsHtml::link(Yii::t('admin', 'send us a message.'), '#', array('class' => 'j-open_support')),
	));
}
?>
