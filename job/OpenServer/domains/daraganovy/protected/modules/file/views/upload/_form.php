<div class="l-form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'b-'.Yii::app()->controller->module->id.'-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class = "l-note"><?=Yii::t('admin', 'Fields with <span class="required">*</span> are required')?></p>

	<?php echo $form->errorSummary($model); ?>

	<div class="l-row">
		<?php echo $form->labelEx($model,'file'); ?>
		<?php echo $form->textField($model,'file',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'file'); ?>
	</div>

	<div class="l-row">
		<?php echo $form->labelEx($model,'file_type'); ?>
		<?php echo $form->textField($model,'file_type',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'file_type'); ?>
	</div>

	<div class="l-row">
		<?php echo $form->labelEx($model,'folder'); ?>
		<?php echo $form->textField($model,'folder',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'folder'); ?>
	</div>

	<div class="l-row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textField($model,'description',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="l-row">
		<?php echo $form->labelEx($model,'position'); ?>
		<?php echo $form->textField($model,'position'); ?>
		<?php echo $form->error($model,'position'); ?>
	</div>

	<div class="l-row">
		<?php echo $form->labelEx($model,'cover'); ?>
		<?php echo $form->textField($model,'cover'); ?>
		<?php echo $form->error($model,'cover'); ?>
	</div>

	<div class="l-row">
		<?php echo $form->labelEx($model,'date'); ?>
		<?php echo $form->textField($model,'date'); ?>
		<?php echo $form->error($model,'date'); ?>
	</div>

	<div class="l-row">
		<?php echo $form->labelEx($model,'model_id'); ?>
		<?php echo $form->textField($model,'model_id'); ?>
		<?php echo $form->error($model,'model_id'); ?>
	</div>

	<div class="l-row">
		<?php echo $form->labelEx($model,'model_name'); ?>
		<?php echo $form->textField($model,'model_name',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'model_name'); ?>
	</div>

	<div class = "g-clear_fix"></div>
	
	<button class = "l-button"><?=$model->isNewRecord ? Yii::t('admin','Create') : Yii::t('admin','Save')?></button>

<?php $this->endWidget(); ?>

</div><!-- l-form -->