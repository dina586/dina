<?php if (Yii::app()->user->hasFlash('recoveryMessage')): ?>
	<div class="alert alert-success">
		<p><i class="fa fa-check"></i> <?= Yii::app()->user->getFlash('recoveryMessage'); ?></p>
	</div>
<?php else: ?>

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
				<?= $form->textField($model, 'login_email', array('class' => 'input-lg')); ?>
				<?php echo $form->error($model, 'login_email'); ?>
			</div>
		</div>
	</div>

	<div class="form-group form-actions">
		<div class="col-xs-12 text-right">
			<button type="submit" class="btn btn-primary">
				<i class="fa fa-angle-right"></i> 
				<?= Yii::t('admin', 'Recover password') ?>
			</button>
		</div>
	</div>

	<?php $this->endWidget(); ?>

<?php endif; ?>