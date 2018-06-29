<div class="l-form">

<?php $form=$this->beginWidget('BsActiveForm', array(
	'id'=>'b-'.Yii::app()->controller->module->id.'-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class = "l-note"><?=Yii::t('admin', 'Fields with <span class="required">*</span> are required')?></p>

	<?php echo $form->errorSummary($model); ?>

	<div class="l-row">
		<?php echo $form->textFieldControlGroup($model,'name'); ?>
	</div>

	<div class="l-row">
		<?php echo $form->textFieldControlGroup($model,'position'); ?>
	</div>
	
	<div class="l-row">
		<?php echo $form->textFieldControlGroup($model, 'email_template'); ?>
	</div>
	
	<div class ="l-row">
		<?php echo $form->dropDownListControlGroup(
			$model,
			'group_id',
			CHtml::listData(UserGroup::model()->findAll(array('order'=>'position, name')), 'id', 'name'),
			array('empty'=>Yii::t('user', 'Choose Group'))
		);
		?>
	</div>

	<div class = "g-clear_fix"></div>
	
	<?=Fields::submitBtn($model->isNewRecord ? Yii::t('admin','Create') : Yii::t('admin','Save'));?>

<?php $this->endWidget(); ?>

</div><!-- l-form -->