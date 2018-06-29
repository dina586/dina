<div class="l-form">

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
	'id'=>'b-'.Yii::app()->controller->module->id.'-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class = "l-note"><?=Yii::t('admin', 'Fields with <span class="required">*</span> are required')?></p>

	<?php echo $form->errorSummary($model); ?>

	<div class="l-row">
		<?php echo $form->textFieldControlGroup($model,'name',array('size'=>60,'maxlength'=>255)); ?>
	</div>
	
	<div class="l-row">
		<?php echo $form->textFieldControlGroup($model,'days'); ?>
		<p class = "l-hint">Number of days when you need to go to the procedure</p>
	</div>
	
	<div class="l-row">
		<?php echo $form->textFieldControlGroup($model,'number'); ?>
		<p class = "l-hint">Procedure number</p>
	</div>
	
	<div class="l-row">
		<?php echo $form->textFieldControlGroup($model,'price'); ?>
	</div>
	
	<div class="l-row">
		<?php echo $form->textFieldControlGroup($model,'procedure_length'); ?>
	</div>
	
	<div class = "l-row">
		<?php 
		echo $form->dropDownListControlGroup(
			$model,
			'service_id',
			CHtml::listData(Service::model()->findAll(array('order'=>'name')), 'id', 'name'),
			array('class'=>'j-choosen', 'empty'=>Yii::t('user', 'Choose Service'))
		);

		Yii::app()->clientScript->registerPackage('choosen');

		JS::add('service_choosen',
		"$('.j-choosen').chosen({
			'search_contains':true,
			'width': '100%'
		});");
		?>
	</div>

	
	<div class="l-row l-checkbox">
		<?php if(!isset($model->is_required)) 
				$model->is_required = 0; 
		?>
		<?php echo $form->checkBoxControlGroup($model,'is_required',array('value' => '1', 'uncheckValue'=>'0')); ?>
		<p class = "l-hint">If this procedure is mandatory for passing, tick this box</p>
	</div>
	
	<div class = "g-clear_fix"></div>
	
	<?=Fields::submitBtn($model->isNewRecord ? Yii::t('admin','Create') : Yii::t('admin','Save'));?>

<?php $this->endWidget(); ?>

</div><!-- l-form -->
