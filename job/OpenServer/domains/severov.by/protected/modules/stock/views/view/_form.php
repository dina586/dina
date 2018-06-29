<div class="l-form">

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
	'id'=>'b-'.Yii::app()->controller->module->id.'-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>

	<p class = "l-note"><?=Yii::t('admin', 'Fields with <span class="required">*</span> are required')?></p>

	<?php echo $form->errorSummary($model); ?>
	
	
	<div class="l-row">
		<?=$form->textFieldControlGroup($model, 'name');?>
	</div>
	
	<div class="l-row">
		<?=$form->textFieldControlGroup($model, 'link');?>
		<p class = "l-hint"><?=Yii::t('admin', 'Direct link to this page. If the link is entered, then the transition will occur on this link, otherwise - on the inside page');?></p>
	</div>
	
	
	<div class="l-row">
		<?=Fields::editor($model, $form); ?>
	</div>

	<div class="l-row">
		<?php if($model->position == '')
			$model->position = 1000;
		?>
		<?=$form->textFieldControlGroup($model, 'position');?>
	</div>

	<div class="l-row l-checkbox">
		<?php if(!isset($model->is_view)) 
			$model->is_view = 1; ?>
		<?php echo $form->checkBoxControlGroup($model,'is_view',array('value' => '1', 'uncheckValue'=>'0')); ?>
	</div>
	
	<div class="l-row l-form_image">
		<?php Fields::fileField($model, $form, Yii::app()->controller->module->folder);?>
	</div>
		
	<?php $this->renderPartial('helper_view.parts._seo', array('model'=>$model, 'form'=>$form));?>

	<div class = "g-clear_fix"></div>
	
	<?=Fields::submitBtn($model->isNewRecord ? Yii::t('admin','Create') : Yii::t('admin','Save'));?>
	
<?php $this->endWidget(); ?>

</div><!-- l-form -->