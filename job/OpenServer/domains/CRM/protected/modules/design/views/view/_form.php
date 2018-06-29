<div class="l-form">

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
	'id'=>'b-'.Yii::app()->controller->module->id.'-form',
	'enableAjaxValidation'=>false,
)); ?>
	
	<div class="block full">
	
		<?php echo $form->errorSummary($model); ?>

		<div class="l-row">
			<?php echo $form->textFieldControlGroup($model,'name',['maxlength'=>255]); ?>
		</div>

		<div class="l-row">
			<?php echo $form->dropDownListControlGroup($model,'catalog_id', $this->module->catalog); ?>
		</div>

		<div class="l-row">
			<?php echo $form->textFieldControlGroup($model,'position'); ?>
		</div>

		<div class = "g-clear_fix"></div>
	
		<?=Fields::submitBtn($model->isNewRecord ? Yii::t('admin','Create') : Yii::t('admin','Save'));?>
		
	</div>
	
<?php $this->endWidget(); ?>

</div><!-- l-form -->