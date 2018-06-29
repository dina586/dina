<div class = "l-form">
	<?php
	$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
		'id' => 'b-'.Yii::app()->controller->module->id.'-form',
		'enableAjaxValidation' => false,
	));
	?>
	
	<div class="block full">

		<?php echo $form->errorSummary($model); ?>

		<div class="l-row">
			<?php echo $form->textFieldControlGroup($model, 'name'); ?>
		</div>

		<div class="l-row">
			<?=Fields::editor($model, $form); ?>
		</div>

		<div class = "clearfix"></div>

		<?=Fields::submitBtn($model->isNewRecord ? Yii::t('admin', 'Create') : Yii::t('admin', 'Save')); ?>
		
	</div>
	
	<?php $this->renderPartial('application.modules.seo.widgets.views.seo_form', array('model' => $model, 'form' => $form)); ?>
	
	<?php $this->endWidget(); ?>

</div><!-- l-form -->
