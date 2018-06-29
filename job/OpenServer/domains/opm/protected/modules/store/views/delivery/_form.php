<div class="l-form">

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
	'id'=>'b-'.Yii::app()->controller->module->id.'-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class = "l-note"><?=Yii::t('admin', 'Fields with <span class="required">*</span> are required')?></p>

	<?php echo $form->errorSummary($model); ?>

	<div class="l-row">
		<?php echo $form->textFieldControlGroup($model,'name',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="l-row">
		<?php echo $form->textFieldControlGroup($model,'us_shipping'); ?>
	</div>

	<div class="l-row">
		<?php echo $form->textFieldControlGroup($model,'int_shipping'); ?>
	</div>

	<div class="l-row">
		<?php echo $form->textFieldControlGroup($model,'position'); ?>
	</div>

	<div class = "g-clear_fix"></div>
	
	<?=Fields::submitBtn($model->isNewRecord ? Yii::t('admin','Create') : Yii::t('admin','Save'));?>

<?php $this->endWidget(); ?>

</div><!-- l-form -->