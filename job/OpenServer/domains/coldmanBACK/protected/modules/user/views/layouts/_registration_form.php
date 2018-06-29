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

<?php echo $form->errorSummary(array($model, $profile)); ?>

<div class="form-group">
	<div class="col-xs-6">
		<div class="input-group">
			<span class="input-group-addon"><i class="gi gi-user"></i></span>
			<?= $form->textField($profile, 'firstname', array('class' => 'input-lg')); ?>
			<?php echo $form->error($profile, 'firstname'); ?>
		</div>
	</div>
	<div class="col-xs-6">
		<?= $form->textField($profile, 'lastname', array('class' => 'input-lg')); ?>
		<?php echo $form->error($profile, 'lastname'); ?>
	</div>
</div>

<div class="form-group">
	<div class="col-xs-12">
		<div class="input-group">
			<span class="input-group-addon"><i class="gi gi-envelope"></i></span>
			<?= $form->textField($model, 'email', array('class' => 'input-lg')); ?>
			<?php echo $form->error($model, 'email'); ?>
		</div>
	</div>
</div>

<div class="form-group">
	<div class="col-xs-12">
		<div class="input-group">
			<span class="input-group-addon"><i class="gi gi-asterisk"></i></span>
			<?= $form->passwordField($model, 'password', array('class' => 'input-lg')); ?>
			<?php echo $form->error($model, 'password'); ?>
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
			<?= Yii::t('admin', 'Register') ?>
		</button>
	</div>
</div>

<?php $this->endWidget(); ?>