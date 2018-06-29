<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'content-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name'); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php 
		$this->widget('ext.editor.CKeditor', array( 
			'model'=>$model,
			'attribute'=>'description',
		));
		?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->hiddenField($model,'url',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'url'); ?>
	</div>
	
		<div class="row">
		<?php echo $form->labelEx($model,'seo_title'); ?>
		<?php echo $form->textArea($model,'seo_title', array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'seo_title'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'seo_keywords'); ?>
		<?php echo $form->textArea($model,'seo_keywords', array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'seo_keywords'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'seo_description'); ?>
		<?php echo $form->textArea($model,'seo_description', array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'seo_description'); ?>
	</div>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->