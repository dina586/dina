<div class="l-form">

	<?php
	$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
		'id' => 'b-' . Yii::app()->controller->module->id . '-form',
		'enableAjaxValidation' => false,
		'htmlOptions' => array('enctype' => 'multipart/form-data'),
	));
	?>

	<p class = "l-note"><?= Yii::t('admin', 'Fields with <span class="required">*</span> are required') ?></p>

<?php echo $form->errorSummary($model); ?>


	<div class="l-row">
<?= $form->textFieldControlGroup($model, 'name'); ?>
	</div>

	<div class="l-row">
<?= Fields::textArea($model, $form); ?>
	</div>

	<div class="l-row">
<?= Fields::editor($model, $form); ?>
	</div>

	<div class="l-row">
<?= Fields::dateField($model, $form); ?>
	</div>

	<div class="l-row l-checkbox">
		<?php if (!isset($model->is_view))
			$model->is_view = 1;
		?>
		<?php echo $form->checkBoxControlGroup($model, 'is_view', array('value' => '1', 'uncheckValue' => '0')); ?>
	</div>

	<?php $this->renderPartial('helper_view.parts._seo', array('model' => $model, 'form' => $form)); ?>

	<div class = "g-clear_fix"></div>

	<?= Fields::submitBtn($model->isNewRecord ? Yii::t('admin', 'Create') : Yii::t('admin', 'Save')); ?>
	<div class ="g-clear_fix"></div>
	<?php
	$id = $model->isNewRecord ? -1 : $model->id;
	$this->widget('file_uploader.UploadWidget', array(
		'postParams' => array(
			'thumbnail' => array('width' => 470, 'height' => 470, 'type' => 'auto'),
			'id' => $id,
			'name' => get_class($model),
			'file_type' => 'image',
		),
	));
	$this->widget('file_uploader.FormWidget', array('id' => $id, 'modelName' => get_class($model)));
	?>

<?php $this->endWidget(); ?>

</div><!-- l-form -->