<?php if (Yii::app()->user->hasFlash('registration')): ?>
	<div class="alert alert-success">
		<p><i class="fa fa-check"></i> <?= Yii::app()->user->getFlash('registration'); ?></p>
	</div>
<?php endif; ?>

<?php
$this->renderPartial('application.modules.user.views.layouts._registration_form', array('model' => $model, 'profile' => $profile));
?>

