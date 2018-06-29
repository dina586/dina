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
		<?=Fields::editor($model, $form, 'description'); ?>
	</div>

	<div class="l-row">
		<?=Fields::editor($model, $form); ?>
	</div>
	
	<div class="l-row">
		<?//=$form->textFieldControlGroup($model, 'tutorial_code');?>
	</div>
	
	<div class="l-row">
		<?//=Fields::editor($model, $form, 'tutorial_code'); ?>
	</div>
	
	<div class="l-row">
		<?=$form->textFieldControlGroup($model, 'video_code');?>
	</div>

	<div class="l-row">
		<?=$form->textFieldControlGroup($model, 'price');?>
	</div>

	<div class="l-row">
		<?php 
			if($model->position == '')
				$model->position = 1000;
		?>
		<?=$form->textFieldControlGroup($model, 'position');?>
	</div>

	<div class="l-row l-checkbox">
		<?php if(!isset($model->is_view)) 
			$model->is_view = 1; ?>
		<?php echo $form->checkBoxControlGroup($model,'is_view',array('value' => '1', 'uncheckValue'=>'0')); ?>
	</div>
	
	<div class="l-row l-form_image">
		<?php Fields::fileField($model, $form, Yii::app()->controller->module->folder);?>
	</div>

	<div class = "g-clear_fix"></div>
	
	<div class = "l-button_wrap">
	
		<?=Fields::submitBtn($model->isNewRecord ? Yii::t('admin','Create') : Yii::t('admin','Save'));?>
	
	</div>
<?php $this->endWidget(); ?>

</div><!-- l-form -->
		
<div class = "g-clear_fix"></div>