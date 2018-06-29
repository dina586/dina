<div class="l-form">

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
	'id'=>'b-'.Yii::app()->controller->module->id.'-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>

	<p class = "l-note"><?=Yii::t('admin', 'Fields with <span class="required">*</span> are required')?></p>

	<?php echo $form->errorSummary($model); ?>
	
	
	<div class="l-row">
		<?=$form->textFieldControlGroup($model, 'name');?>
	</div>
	
	<div class="l-row">
		<?php if($model->position == '')
			$model->position = 1000;
		?>
		<?=$form->textFieldControlGroup($model, 'position');?>
	</div>

	<div class="l-row l-form_image">
		<?php Fields::fileField($model, $form, Yii::app()->controller->module->frontFolder);?>
	</div>
		

	<div class = "g-clear_fix"></div>
	
	<?=Fields::submitBtn($model->isNewRecord ? Yii::t('admin','Create') : Yii::t('admin','Save'));?>
	
<?php $this->endWidget(); ?>

</div><!-- l-form -->