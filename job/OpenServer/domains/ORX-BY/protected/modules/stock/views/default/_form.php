<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'block-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'content'); ?>
		<?php 
		$this->widget('ext.editor.CKeditor', array( 
			'model'=>$model,
			'attribute'=>'content',
		));
		?>
		<p class = "hint">Для вывода даты впишите в тексе {date}</p>
		<?php echo $form->error($model,'content'); ?>
	</div>

		<div class="row">
		<?php echo $form->labelEx($model,'date'); ?>
		<?php 
		if(!isset($model->date)) {
			$model->date = date("Y-m-d");
		}
		$this->widget('zii.widgets.jui.CJuiDatePicker', array(
		    'name'=>'Stock[date]',
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
		<div class = "radio_button">
		<?php 
			if(!isset($model->is_view)) {
				$model->is_view = 1;
			}
			echo $form->radioButtonList($model,'is_view',array('0'=>'Скрыт', '1'=>'Отображается'), array('separator'=>'<br/>'));
		?>
		<?php echo $form->error($model,'is_view'); ?>
		</div>
	</div>
	
	<div class="row radio_button">
		<?php echo $form->labelEx($model,'refresh'); ?>
		<div class = "radio_button">
		<?php 
			if(!isset($model->refresh)) {
				$model->refresh = 1;
			}
			echo $form->radioButtonList($model,'refresh',array('0'=>'Нет', '1'=>'Да'), array('separator'=>'<br/>'));
		?>
		<?php echo $form->error($model,'refresh'); ?>
		</div>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->