<div class="l-form">

<?php 
Yii::app ()->clientScript->registerScriptFile('/themes/crm/js/plugins/bootstrap/bootstrap-colorpicker.js');
$form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
	'id'=>'b-'.Yii::app()->controller->module->id.'-form',
	'enableAjaxValidation'=>false,
)); ?>


	<?php echo $form->errorSummary($model); ?>

	<div class="l-row">
		<?php echo $form->textFieldControlGroup($model,'name'); ?>
	</div>

	<div class="l-row">
		<?php echo $form->textFieldControlGroup($model,'color', array('class'=>'colorpicker')); ?>
	</div>
	
	<div class="l-row">
		<?=Fields::editor($model, $form, 'description'); ?>
	</div>

	<div class = "g-clear_fix"></div>
	
	<?=Fields::submitBtn($model->isNewRecord ? Yii::t('admin','Create') : Yii::t('admin','Save'));?>

<?php $this->endWidget(); ?>

</div><!-- l-form -->