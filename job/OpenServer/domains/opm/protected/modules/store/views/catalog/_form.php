<div class="l-form">

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
	'id'=>'b-'.Yii::app()->controller->module->id.'-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>

	<p class = "l-note"><?=Yii::t('admin', 'Fields with <span class="required">*</span> are required')?></p>

	<?php echo $form->errorSummary($model); ?>

	<div class="l-row">
		<?php echo $form->textFieldControlGroup($model,'name'); ?>
	</div>

	<div class="l-row">
		<?php 
			if(!isset($model->position)) 
			$model->position = 1000; 
		?>
		<?php echo $form->textFieldControlGroup($model,'position'); ?>
	</div>
	
	<div class="l-row l-checkbox">
		<?php if(!isset($model->is_view)) 
				$model->is_view = 1; 
		?>
		<?php echo $form->checkBoxControlGroup($model,'is_view',array('value' => '1', 'uncheckValue'=>'0')); ?>
	</div>
	
	<div class="l-row">
		<?=Fields::editor($model, $form); ?>
	</div>
	

	<?php $this->renderPartial('helper_view.parts._seo', array('model'=>$model, 'form'=>$form));?>

	<div class = "b-admin_catalog_tree">
		<?php 
			$ShopHelper = new StoreHelper;
			$ShopHelper->generateForm(-1, $model->id, $model->parent_id);
		?>
	</div>

	
	<div class = "g-clear_fix"></div>
	
	<?=Fields::submitBtn($model->isNewRecord ? Yii::t('admin','Create') : Yii::t('admin','Save'));?>

<?php $this->endWidget(); ?>

</div><!-- form -->
