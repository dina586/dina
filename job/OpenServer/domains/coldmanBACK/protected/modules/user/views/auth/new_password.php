<?php

if ($json['error'] === true) {
	$this->renderPartial('/layouts/message', array('json' => $json));
	echo Yii::t('admin', 'If You have any problems with password changing, please, write to {link} or {message}', array(
		'{link}' => BsHtml::mailto(Settings::getVal('site_email')),
		'{message}' => BsHtml::link(Yii::t('admin', 'send us a message.'), '#', array('class' => 'j-open_support')),
	));
} elseif (Yii::app()->user->hasFlash('recoveryComplete')){
	echo Yii::app()->user->getFlash('recoveryComplete');
}
else
	$this->renderPartial('application.modules.user.views.auth._new_password_form', array('model' => $model));

