<div class="l-form">

	<?php
	$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
		'id' => 'b-'.Yii::app()->controller->module->id.'-form',
		'enableAjaxValidation' => false,
	));
	?>

	<div class="block full">
		<?php echo $form->errorSummary($model); ?>

		<?php
		if (!Yii::app()->user->checkAccess("developer")) {
			$model->name = Yii::t("admin", $model->name);
		}
		?>

		<div class="l-row">
			<?php echo $form->textFieldControlGroup($model, 'name'); ?>
		</div>

		<div class="l-row">
			<?php echo $form->textFieldControlGroup($model, 'tag'); ?>
		</div>

		<div class="l-row">
			<?php echo $form->dropDownListControlGroup($model, 'tag_type', $this->module->tagType); ?>
		</div>

		<div class = "clearfix"></div>

	<?=Fields::submitBtn($model->isNewRecord ? Yii::t('admin', 'Create') : Yii::t('admin', 'Save')); ?>

	</div>
<?php $this->endWidget(); ?>

</div><!-- l-form -->