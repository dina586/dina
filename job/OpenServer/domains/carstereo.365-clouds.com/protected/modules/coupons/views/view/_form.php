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
                        <?=Fields::textArea($model, $form);?>
                </div>

                <div class="l-row">
                        <?=Fields::editor($model, $form); ?>
                </div>

                <div class="l-row">
                        <?=Fields::dateField($model, $form, 'expire_date'); ?>
                </div>
                <div class="l-row">
                        <?php echo $form->textFieldControlGroup($model, 'code'); ?>
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
	
	<?php $this->renderPartial('application.modules.seo.widgets.views.seo_form', array('model' => $model, 'form' => $form)); ?>
	
	<?php $this->endWidget(); ?>

</div><!-- l-form -->