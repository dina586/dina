<?php 
	if($model->start_date != '') {
		$model->f_start_date = date(System::getDateFormat(), strtotime($model->start_date));
		$model->f_start_time = date('h:i a', strtotime($model->start_date));
	}
	
	if($model->end_date != '') {
		$model->f_end_date = date(System::getDateFormat(), strtotime($model->end_date));
		$model->f_end_time = date('h:i a', strtotime($model->end_date));
	}

	//$model->f_start_date = date(System::getDateFormat(), strtotime($model->start_date));
	//$model->f_end_date = System::viewDate(strtotime($model->end_date));
	
	//$model->f_start_time = date('h:i a', strtotime($model->start_date));
	//$model->f_end_time = date('h:i a', strtotime($model->end_date));
?>
<div class="l-form">

<?php 
Yii::app()->clientScript->registerScriptFile('/themes/crm/js/plugins/bootstrap/bootstrap-timepicker.min.js');
$form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
	'id'=>'b-'.Yii::app()->controller->module->id.'-form',
	'enableAjaxValidation'=>false,
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>


	<?php echo $form->errorSummary($model); ?>

	<div class="l-row">
		<?php echo $form->textFieldControlGroup($model,'name',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class = "col-md-6">
		<div class="l-row">
			<?=Fields::dateField($model, $form, 'f_start_date'); ?>
		</div>
	</div>
	
	<div class = "col-md-6">
		<div class="l-row bootstrap-timepicker">
			<?php echo $form->textFieldControlGroup($model,'f_start_time', array('class'=>'timepicker')); ?>
		</div>
	</div>
	
	<div class = "g-clear_fix"></div>
	
	<div class = "col-md-6">
		<div class="l-row">
			<?=Fields::dateField($model, $form, 'f_end_date'); ?>
		</div>
	</div>
	
	<div class = "col-md-6">
		<div class="l-row bootstrap-timepicker">
			<?php echo $form->textFieldControlGroup($model,'f_end_time', array('class'=>'timepicker')); ?>
		</div>
	</div>

	
	<div class = "g-clear_fix"></div>
	
	<div class="l-row">
		<?php echo $form->dropDownListControlGroup($model,'worker_id', CHtml::listData(CalendarWorkers::model()->findAll(), 'id', 'name')); ?>
	</div>

	<div class="l-row">
		<?php echo $form->hiddenField($model,'status'); ?>
	</div>
	
	<div class = "l-row j-choose_procedure">
		<?=Fields::procedureField($model, $form, 'procedure_id', $model->procedure_id, true)?>
	</div>
	
	<div class = "l-row">
		<div class = "form-group">
			<?php echo $form->labelEx($model,'user_name'); ?>
			<div>
				<?php 
					$this->widget('CAutoComplete', array(
						'model'=>$model,
						'attribute'=>'user_name',
						'url'=>Yii::app()->createUrl('invoice/view/getUser'),
						'htmlOptions'=>array('placeholder'=>Yii::t('user','Enter Client Name'), 'class'=>'form-control'),
					));
				?>
			</div>
			<?php echo $form->error($model, 'user_name');?>
		</div>
	</div>
	
	<div class = "l-row">
		<?=Helper::linkButton('Quick Client Registration', Yii::app()->createUrl('/user/admin/quick'), array('color' => BsHtml::BUTTON_COLOR_SUCCESS, 'target'=>'_blank'));?>
	</div>
		
	<div class="l-row">
		<?php echo $form->textAreaControlGroup($model,'content'); ?>
	</div>
	
	<div class = "g-clear_fix"></div>
	
	<?php 
		if($this->action->id == 'index'):
	?>
		<?=Fields::submitBtn(Yii::t('admin','Create'), BsHtml::GLYPHICON_FLOPPY_SAVE, array('class'=>'a-add_event'));?>
		<?=Fields::submitBtn('Hide', BsHtml::GLYPHICON_ARROW_UP, array('class'=>'j-caledar_form_hide'));?>
	<?php else:?>
	
		<div class="l-button_wrap">
			<?=Fields::submitBtn($model->isNewRecord ? Yii::t('admin','Create') : Yii::t('admin','Save'));?>
		</div>
	<?php endif;?>
<?php $this->endWidget(); ?>

</div><!-- l-form -->