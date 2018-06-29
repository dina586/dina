<div class = "l-form">
	<?php
	$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
		'id' => 'b-' . Yii::app()->controller->module->id . '-form',
		'enableAjaxValidation' => false,
		'htmlOptions' => array('enctype' => 'multipart/form-data'),
	));
	?>
	<div class="block full">
		<?php echo $form->errorSummary($model); ?>

		<div class="l-row">
			<?= $form->textFieldControlGroup($model, 'name'); ?>
		</div>

		<div class="l-row">
			<?=Fields::editor($model, $form); ?>
		</div>

		

		<div class="l-row l-checkbox">
			<?php if (!isset($model->is_view))
				$model->is_view = 1;
			?>
			<?php echo $form->checkBoxControlGroup($model, 'is_view', array('value' => '1', 'uncheckValue' => '0')); ?>
		</div>

		<div class = "g-clear_fix"></div>

		<?= Fields::submitBtn($model->isNewRecord ? Yii::t('admin', 'Create') : Yii::t('admin', 'Save')); ?>
	</div>	

	<?php
	$id = $model->isNewRecord ? -1 : $model->id;
	$this->widget('application.modules.seo.widgets.SeoWidget', [
		'id' => $id,
		'modelName' => get_class($model),
		'form' => $form,
	]);
	?>

<?php $this->endWidget(); ?>

</div><!-- l-form -->

<div class = "block full clearfix">
	<?php
	$id = $model->isNewRecord ? -1 : $model->id;
	$this->widget('file_uploader.UploadWidget', array(
		'postParams' => array(
			'thumbnail' => array('width' => 150, 'height' => 150),
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
