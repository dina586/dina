<?php
$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
	//'enableClientValidation' => true,
	'enableAjaxValidation'=>true,
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
	<?= $form->errorSummary($model); ?>
</div>

<div class="col-md-12">
	<div class="block last_no_border">

		<div class="block-title">
			<h2><?=Yii::t('admin', 'To change your current password, please, enter a new password to the fields below.');?></h2>
		</div>

		<?php
		echo $form->passwordFieldControlGroup($model, 'old_password', array(
			'append' => '<i class="fa fa-cog"></i>',
		));
		?>

		<?php
		echo $form->passwordFieldControlGroup($model, 'new_password', array(
			'append' => '<i class="fa fa-check"></i>',
		));
		?>

		<?php
		echo $form->passwordFieldControlGroup($model, 'confirm_password', array(
			'append' => '<i class="fa fa-exclamation-triangle"></i>',
		));
		?>


	</div>
</div>

<div class ="col-md-12">
	<?= Fields::submitBtn($model->isNewRecord ? Yii::t('admin', 'Create') : Yii::t('admin', 'Save')); ?>
</div>

<?php $this->endWidget(); ?>
