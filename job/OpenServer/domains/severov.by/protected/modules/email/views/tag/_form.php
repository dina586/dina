<div class="l-form">

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
	'id'=>'b-'.Yii::app()->controller->module->id.'-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class = "l-note"><?=Yii::t('admin', 'Fields with <span class="required">*</span> are required')?></p>

	<?php echo $form->errorSummary($model); ?>
	
	<?php if(!Yii::app()->user->checkAccess("developer")) {
		$model->name = Yii::t("admin", $model->name);
	}
	?>
	
	<div class="l-row">
		<?php echo $form->textFieldControlGroup($model,'name'); ?>
	</div>
	
	<div class="l-row">
		<?php echo $form->textFieldControlGroup($model,'tag'); ?>
	</div>
	
	<div class="l-row">
		<?php echo $form->dropDownListControlGroup($model,'tag_type', $this->module->tagType); ?>
	</div>
		
	<div class = "g-clear_fix"></div>
	
	<?=Fields::submitBtn($model->isNewRecord ? Yii::t('admin','Create') : Yii::t('admin','Save'));?>

<?php $this->endWidget(); ?>

</div><!-- l-form -->