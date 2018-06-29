<div class="block full l-form">

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
	'id'=>'b-'.Yii::app()->controller->module->id.'-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>
	
	<?php if(!Yii::app()->user->checkAccess("developer"))
		$model->name = Yii::t("admin", $model->name);
	?>
	
	<div class="l-row">
		<?php echo $form->textFieldControlGroup($model,'name'); ?>
	</div>
	
	<div class="l-row">
		<?php echo $this->getField($model->element, $model, $form) ?>
	</div>
	
	<?php if(Yii::app()->user->checkAccess("developer")):?>
		
		<div class="l-row">
			<?php echo $form->textFieldControlGroup($model,'base_key'); ?>
		</div>
		
		<div class="l-row">
			<?php echo $form->dropDownListControlGroup($model,'element', $this->module->settingsFields); ?>
		</div>
		
		<div class="l-row">
			<?php echo $form->dropDownListControlGroup($model,'module_id', $this->module->settingsModules); ?>
		</div>
		
		<div class="l-row">
			<?php echo $form->dropDownListControlGroup($model,'visible', array('admin'=>'admin', 'developer'=>'developer')); ?>
		</div>
			
		<div class="l-row">
			<?php echo $form->checkboxControlGroup($model,'view_in_grid'); ?>
		</div>
		
		<div class="l-row">
			<?php echo $form->textAreaControlGroup($model,'comment'); ?>
		</div>
	
	<?php else: ?>
		<div class="l-row">
			<p class = "l-hint"><?=Yii::t("admin", $model->comment); ?></p>
		</div>
	<?php endif;?>
	
	<div class = "g-clear_fix"></div>
	
	<?=Fields::submitBtn($model->isNewRecord ? Yii::t('admin','Create') : Yii::t('admin','Save'));?>

<?php $this->endWidget(); ?>

</div><!-- l-form -->