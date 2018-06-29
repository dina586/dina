<div class="l-form">

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
	'id'=>'b-'.Yii::app()->controller->module->id.'-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>
	<div class="block full">

		<?php echo $form->errorSummary($model); ?>

		<div class="l-row">
			<?php echo $form->textFieldControlGroup($model, 'name'); ?>
		</div>
                <div class="l-row">
			<?php echo $form->textFieldControlGroup($model, 'alt'); ?>
		</div>
                <div class="l-row">
			<?php echo $form->textFieldControlGroup($model, 'title'); ?>
		</div>
		
		<div class="l-row l-checkbox">
                    <?php if (!isset($model->is_view))
                            $model->is_view = 1;
                    ?>
                    <?php echo $form->checkBoxControlGroup($model, 'is_view', array('value' => '1', 'uncheckValue' => '0')); ?>
		</div>
		<div class="l-row l-form_image">
			<?php Fields::fileField($model, $form, Yii::app()->controller->module->folder);?>
		</div>		
		<div class = "clearfix"></div>

		<?=Fields::submitBtn($model->isNewRecord ? Yii::t('admin', 'Create') : Yii::t('admin', 'Save')); ?>
		
	</div>
	
	
	<?php $this->endWidget(); ?>
	
</div><!-- l-form -->