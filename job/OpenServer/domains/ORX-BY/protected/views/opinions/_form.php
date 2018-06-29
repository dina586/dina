<div class="form">

<?php 
if(!$model->isNewRecord)
Opinions::checkNew($model->id);

$form=$this->beginWidget('CActiveForm', array(
	'id'=>'opinions-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('enctype'=>'multipart/form-data')
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'text'); ?>
		<?php echo $form->textArea($model,'text',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'text'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date'); ?>
		
		<?php 
		if(!isset($model->date)) {
			$model->date = date("Y-m-d");
		}
		$this->widget('zii.widgets.jui.CJuiDatePicker', array(
		    'name'=>'Opinions[date]',
			'value'=> $model->date,
			'language'=> Yii::app()->language,
		    'options'=>array(
		        'showAnim'=>'fold',
				'dateFormat'=>'yy-mm-dd',
				'constrainInput'=> 'true',
		    ),
		    'htmlOptions'=>array(
		    ),
		));
	?>
		<?php echo $form->error($model,'date'); ?>
	</div>

	<div class="row radio_button">
		
		<?php echo $form->labelEx($model,'is_view'); ?>
		<br/>
		<?php 
		if(!isset($model->is_view)){
			$model->is_view = 1;
		}
			echo CHtml::activeRadioButtonList($model, 'is_view', array('1'=>'Отображается','0'=>'Скрыт'), array('separator'=>'<br/>'));
		?>
		<?php echo $form->error($model,'is_view'); ?>
	</div>
		
	<div class="row">
		<?php echo $form->labelEx($model,'image'); 	?>
		<?php echo $form->fileField($model, 'image'); 
		$path = ROOT_PATH.DIRECTORY_SEPARATOR."upload".DIRECTORY_SEPARATOR."opinions".DIRECTORY_SEPARATOR.$model->id.".jpg";
		if(file_exists($path)){
			echo '<br/><img src = "../../upload/opinions/'.$model->id.'.jpg" />';
		}
		?>
	
	<?php 
		echo $form->hiddenField($model,'is_new', array('value' => '0'));
	?>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->