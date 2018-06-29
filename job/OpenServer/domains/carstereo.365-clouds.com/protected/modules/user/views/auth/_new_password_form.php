
	<?php
	$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
		'id' => 'form-login',
		'enableClientValidation' => true,
		'htmlOptions' => array(
			'class' => 'form-horizontal form-bordered form-control-borderless',
		),
		'clientOptions' => array(
			'validateOnSubmit' => true,
		),
	));
	?>

	<?php echo $form->errorSummary($model); ?>

	<div class="form-group">
		<div class="col-xs-12">
			<div class="input-group">
				<span class="input-group-addon"><i class="gi gi-asterisk"></i></span>
				<?= $form->passwordField($model, 'new_password', array('class' => 'input-lg')); ?>
				<?php echo $form->error($model, 'new_password'); ?>
			</div>
		</div>
	</div>

	<div class="form-group">
		<div class="col-xs-12">
			<div class="input-group">
				<span class="input-group-addon"><i class="gi gi-asterisk"></i></span>
					<?= $form->passwordField($model, 'confirm_password', array('class' => 'input-lg')); ?>
					<?php echo $form->error($model, 'confirm_password'); ?>		
			</div>
		</div>
	</div>

	<div class="form-group form-actions">
		<div class="col-xs-12 text-right">
			<button type="submit" class="btn btn-primary">
				<i class="fa fa-angle-right"></i> 
				<?= Yii::t('admin', 'Save') ?>
			</button>
		</div>
	</div>

	<?php $this->endWidget(); ?>

