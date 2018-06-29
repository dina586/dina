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
			<span class="input-group-addon"><i class="gi gi-envelope"></i></span>
			<?= $form->textField($model, 'login', array('class' => 'input-lg')); ?>
			<?php echo $form->error($model, 'login'); ?>
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

<div class="form-group form-actions">
	<div class="col-xs-4">
		<label class="switch switch-primary" data-toggle="tooltip" title="<?= Yii::t('admin', 'Remember Me?') ?>">
			<?= $form->checkBox($model, 'rememberMe', array('checked' => 'checked', 'id' => 'login-remember-me')); ?>
			<span></span>
		</label>
	</div>
	<div class="col-xs-8 text-right">
		<button type="submit" class="btn btn-primary">
			<i class="fa fa-angle-right"></i> 
			<?= Yii::t('admin', 'Login') ?>
		</button>
	</div>
</div>

<div class="form-group">
	<div class="col-xs-12 text-center">
		<a href="<?= Yii::app()->createUrl('user/auth/recovery') ?>">
			<small>Forgot password?</small>
		</a> 
		-
		<a href="<?= Yii::app()->createUrl('user/auth/registration') ?>">
			<small>Create a new account</small>
		</a>
	</div>
</div>
<?php $this->endWidget(); ?>