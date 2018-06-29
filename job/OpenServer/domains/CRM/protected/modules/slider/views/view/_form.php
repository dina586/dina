<div class="l-form">

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
	'id'=>'b-'.Yii::app()->controller->module->id.'-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>
	
	<div class="block full">
	
		<?php echo $form->errorSummary($model); ?>

		<div class="l-row">
			<?php echo $form->textFieldControlGroup($model,'name',['maxlength'=>255]); ?>
		</div>

		<div class="l-row">
			<?php echo $form->textFieldControlGroup($model,'position'); ?>
		</div>
		
		<?php 
			echo $form->labelEx($model,'image');
			echo $form->fileField($model, 'image');			
		?>
		<p>Для лучшего отображения используйте картинки помещенные в прямоугольник с размерами 195х70</p>
		<div class = "g-clear_fix"></div>
	
		<?=Fields::submitBtn($model->isNewRecord ? Yii::t('admin','Create') : Yii::t('admin','Save'));?>
		
	</div>
	
<?php $this->endWidget(); ?>

</div><!-- l-form -->