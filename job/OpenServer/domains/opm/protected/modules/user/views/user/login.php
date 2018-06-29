<div class="login-title">
	<strong>Welcome</strong>, Please login
</div>

<?php $form = $this->beginWidget('bootstrap.widgets.BsActiveForm',
	array(
		'id'=>'b-login-form',
		'layout' => BsHtml::FORM_LAYOUT_HORIZONTAL,
		'enableAjaxValidation'=>false,
		'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
));
?>
	<?php echo $form->errorSummary($model); ?>
	
	<div class = "g-clear_fix"></div>
	
	<div class="form-group l-no_label">
		<div class="col-md-12">
			<?php echo $form->textFieldControlGroup($model,'username')?>
		</div>
	</div>
	
	<div class="form-group l-no_label">
		<div class="col-md-12">
			<?php echo $form->passwordFieldControlGroup($model,'password')?>
		</div>
	</div>
	
	<div class="form-group">
		<div class="col-md-6">
			<a href="<?=Yii::app()->createUrl('user/recovery');?>" class="btn btn-link btn-block">Forgot your password?</a>
		</div>
		<div class="col-md-6">
			<button class="btn btn-success btn-block">Log In</button>
		</div>
	</div>

<?php $this->endWidget(); ?>
