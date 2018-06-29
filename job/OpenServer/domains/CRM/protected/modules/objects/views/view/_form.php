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
			<?=Fields::editor($model, $form); ?>
		</div>

		<div class="l-row">
			<?php echo $form->textFieldControlGroup($model,'position'); ?>
		</div>

		<div class = "g-clear_fix"></div>
	
		<?=Fields::submitBtn($model->isNewRecord ? Yii::t('admin','Create') : Yii::t('admin','Save'));?>
		
	</div>
	
	
	
<?php $this->endWidget(); ?>

</div><!-- l-form -->

<div class = "block full clearfix">
	<?php
	$id = $model->isNewRecord ? -1 : $model->id;
	$this->widget('file_uploader.UploadWidget', array(
		'postParams' => array(
			'thumbnail' => array('width' => 350, 'height' => 280),
			'medium' => array('width' => 324, 'height' => 324, 'type' => 'landscape'),
			'id' => $id,
			'name' => get_class($model),
			'file_type' => 'any',
			''
		),
		'originalName'=>true,
	));
	?>
<?php $this->widget('file_uploader.FormWidget', array('id' => $id, 'modelName' => get_class($model))); ?>
</div>