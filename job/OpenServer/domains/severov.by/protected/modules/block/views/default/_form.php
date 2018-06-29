<div class="l-form">

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
	'id'=>'b-'.Yii::app()->controller->module->id.'-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class = "l-note"><?=Yii::t('admin', 'Fields with <span class="required">*</span> are required')?></p>
	
	<?php echo $form->errorSummary($model); ?>

	<div class="l-row">
		<?=$form->textFieldControlGroup($model, 'name');?>
	</div>
	
	<div class="l-row">
		<?=$form->textFieldControlGroup($model, 'title');?>
	</div>
	
	<div class="l-row">
		<?=Fields::editor($model, $form); ?>
	</div>
	
	<div class="l-row">
		<?php echo $form->dropDownListControlGroup($model,'page_position', $this->module->namespace); ?>
		<p class = "l-hint"><?=Yii::t('admin', 'Selecting a site area where this unit will be displayed');?></p>
	</div>

	<?php 
	if(!isset($model->position))
		$model->position = 1000;
	?>
	<div class="l-row">
		<?=$form->textFieldControlGroup($model, 'position');?>
		<p class = "l-hint"><?=Yii::t('admin', 'Positioning unit relative to another unit in the output. Blocks with the lower numbers are displayed before, with more - later.');?></p>	
	</div>
	
	<div class="l-row l-checkbox">
		<?php if(!isset($model->is_view)) 
			$model->is_view = 1; ?>
		<?php echo $form->checkBoxControlGroup($model,'is_view',array('value' => '1', 'uncheckValue'=>'0')); ?>
	</div>
	
	<div class="l-row l-checkbox">
		<?php echo $form->checkBoxControlGroup($model,'view_title',array('value' => '1', 'uncheckValue'=>'0')); ?>
	</div>
	
	<div class = "g-clear_fix"></div>
	
	<?=Fields::submitBtn($model->isNewRecord ? Yii::t('admin','Create') : Yii::t('admin','Save'));?>

<?php $this->endWidget(); ?>

</div><!-- l-form -->