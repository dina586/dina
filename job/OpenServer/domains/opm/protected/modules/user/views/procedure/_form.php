<?php 
Yii::app()->clientScript->registerPackage('service');
Yii::import('application.modules.calendar.models.CalendarWorkers');


?>
<div class="l-form">

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
	'id'=>'b-'.Yii::app()->controller->module->id.'-form',
)); ?>

	<p class = "l-note"><?=Yii::t('admin', 'Fields with <span class="required">*</span> are required')?></p>

	<?php echo $form->errorSummary($model); ?>
	
	<div class = "l-row a-procedure">
		<?=Fields::procedureField($model, $form, 'procedure_id', true)?>
	</div>
	
	<div class="l-row d-procedure_price">
		<?php echo $form->textFieldControlGroup($model,'price'); ?>
	</div>
	
	 <div class = "l-row">
		<?=Fields::dateTimeField($model, $form, 'visit_date', false);?>
		<?php 
		
		
		if(!$model->isNewRecord) {
			$class = "g-visible";
			$l = $model->procedure->procedure_length;
		}
		else {
			$class = "g-hidden";
			$l = '';
		}
		?>
		<p class = "l-hint j-show_procedure <?=$class?>">Procedure length - <span class = "j-procedure_length_text"><?=$l?></span> minutes</p>
	</div>
	
	<div class = "l-row">
		<?=Fields::textArea($model, $form, 'comment');?>
	</div>

	<div class="l-row l-checkbox">
		<?php echo $form->checkBoxControlGroup($model,'is_visit'); ?>
		<p class = "l-hint">Whether the customer has visited the procedure</p>
	</div>
	
	<div class = "g-clear_fix"></div>
	
	<div class="l-row l-checkbox j-show_worker">
		<?php 
		if($model->view_in_calendar == '' && !$_POST)
			$model->view_in_calendar = 1;
		echo $form->checkBoxControlGroup($model,'view_in_calendar'); ?>
	</div>
	
	<?php 
	if($model->view_in_calendar == 1)
		$class = "g-visible";
	else
		$class = "g-hidden";
	?>
	
	<div class = "l-row j-view_service_worker <?=$class?>">
		<?php 
		echo $form->dropDownListControlGroup(
			$model,
			'worker_id',
			CHtml::listData(CalendarWorkers::model()->findAll(array('order'=>'name')), 'id', 'name'),
			array('class'=>'j-choosen', 'empty'=>Yii::t('user', 'Choose Employee'))
		);

	?>
	</div>
	
	<div class = "g-clear_fix"></div>
	
	<?=Fields::submitBtn($model->isNewRecord ? Yii::t('admin','Create') : Yii::t('admin','Save'));?>
	<?=Fields::submitBtn(Yii::t('admin','Save and go to Calendar'));?>
	
	<div class = "g-clear_fix"></div>
	
	<?php 
	$id = $model->isNewRecord?-1:$model->id;
	$this->widget('file_uploader.UploadWidget', array(
		'postParams'=>array(
			'thumbnail'=>array('width'=>150, 'height'=>150),		
			'id'=>$id,
			'name'=>get_class($model),
			'file_type'=>'image',
			'cover'=>false,
		),
	));
	$this->widget('file_uploader.FormWidget', array('id'=>$id, 'modelName'=>get_class($model), 'cover'=>false));
	?>
	
	<div class = "g-clear_fix"></div>
	
	<var class = "j-procedure_length g-hidden"><?=$model->isNewRecord?"":$model->procedure->procedure_length;?></var>
	

<?php $this->endWidget(); ?>

</div><!-- l-form -->
