<div class="l-form">

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
	'id'=>'b-'.Yii::app()->controller->module->id.'-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>

	<p class = "l-note"><?=Yii::t('admin', 'Fields with <span class="required">*</span> are required')?></p>

	<?php echo $form->errorSummary($model); ?>

	<div class="l-row">
		<?php echo $form->textFieldControlGroup($model,'client_name'); ?>
	</div>
	
	<div class="l-row">
		<?php echo $form->textFieldControlGroup($model,'address'); ?>
	</div>
	
	<div class="l-row">
		<?php echo $form->textFieldControlGroup($model,'tax'); ?>
	</div>
	
	<div class="l-row">
		<?php echo $form->textFieldControlGroup($model,'payment'); ?>
	</div>
	
	<div class="l-row">
		<?=Fields::dateField($model, $form, 'due_date', false); ?>
	</div>

	
	<div class = "g-clear_fix"></div>
	
	<?=Fields::submitBtn($model->isNewRecord ? Yii::t('admin','Create') : Yii::t('admin','Save'));?>
	<?=Fields::submitBtn('Save And Print', BsHtml::GLYPHICON_PRINT);?>

<?php $this->endWidget(); ?>

</div><!-- form -->
