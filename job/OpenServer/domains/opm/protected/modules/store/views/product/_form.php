<div class="l-form">

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
	'id'=>'b-'.Yii::app()->controller->module->id.'-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class = "l-note"><?=Yii::t('admin', 'Fields with <span class="required">*</span> are required')?></p>

	<?php echo $form->errorSummary($model); ?>

	<div class="l-row">
		<?php echo $form->textFieldControlGroup($model,'name'); ?>
	</div>

	<div class="l-row">
		<?=Fields::textArea($model, $form);?>
	</div>

	<div class="l-row">
		<?=Fields::editor($model, $form); ?>
	</div>
	
	<div class="l-row">
		<?php echo $form->textFieldControlGroup($model,'articul'); ?>
	</div>
	
	<div class="l-row">
		<?php echo $form->textFieldControlGroup($model,'price'); ?>
	</div>
	
	<div class="l-row">
		<?if($model->share_price == 0)
			$model->share_price = '';
			?>
		<?php echo $form->hiddenField($model,'share_price'); ?>
	</div>
	
	<div class="l-row">
		<?=Fields::dateField($model, $form); ?>
	</div>
		
	<div class="l-row">
		<?php if(!isset($model->position)) 
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
	
	<div class="l-row l-checkbox">
		<?php if(!isset($model->status)) 
				$model->status = 1; 
		?>
		<?php echo $form->checkBoxControlGroup($model,'status',array('value' => '1', 'uncheckValue'=>'0')); ?>
	</div>

	<div class="l-row l-checkbox">
		<?php echo $form->hiddenField($model,'is_new', array('value'=>0)); ?>
	</div>
	
	<div class="l-row l-checkbox">
		<?php echo $form->hiddenField($model,'popular', array('value'=>0)); ?>
	</div>
	
	<div class="l-row l-checkbox">
		<?php echo $form->hiddenField($model,'stock', array('value'=>0)); ?>
	</div>
	
	<?php $this->renderPartial('helper_view.parts._seo', array('model'=>$model, 'form'=>$form));?>
	
	<div class = "g-clear_fix"></div>
		
	<div class = "b-admin_catalog_tree">
		<?php 
			$store = new StoreHelper();
			$store->generateForm(-1, '', $model->id, -1, 'checkbox');
		?>
	</div>
	
	<?=Fields::submitBtn($model->isNewRecord ? Yii::t('admin','Create') : Yii::t('admin','Save'));?>
	
	<?php 
	$id = $model->isNewRecord?-1:$model->id;
	$this->widget('file_uploader.UploadWidget', array(
		'postParams'=>array(
			'thumbnail'=>array('width'=>260, 'height'=>200),		
			'medium'=>array('width'=>324, 'height'=>324, 'type'=>'landscape'),		
			'id'=>$id,
			'name'=>get_class($model),
			'file_type'=>'any',
		),
	));
	$this->widget('file_uploader.FormWidget', array('id'=>$id, 'modelName'=>get_class($model)));
	?>
	
<?php $this->endWidget(); ?>


</div><!-- l-form -->
