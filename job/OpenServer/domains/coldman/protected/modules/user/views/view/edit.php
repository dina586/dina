<?php
$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
	'enableClientValidation' => true,
	'layout' => BsHtml::FORM_LAYOUT_HORIZONTAL,
	'htmlOptions' => array(
		'class' => 'form-bordered',
	),
	'clientOptions' => array(
		'validateOnSubmit' => true,
	),
));
?>

<div class = "col-md-12">
	<?= $form->errorSummary(array($model, $profile)); ?>
</div>

<?php
$this->renderPartial('application.modules.user.views.view._base_form', ['model'=>$model, 'profile'=>$profile, 'form'=>$form]);
?>

<div class ="clearfix"></div>

<div class ="col-md-12">
	<?= Fields::submitBtn($model->isNewRecord ? Yii::t('admin', 'Create') : Yii::t('admin', 'Save')); ?>
</div>

<?php $this->endWidget(); ?>

