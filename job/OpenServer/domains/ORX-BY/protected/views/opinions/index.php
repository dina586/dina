<?php 
$this->pageTitle = 'Отзывы'; 
?>
<div class = "b-about">
	<h3 class = "page_title">Отзывы</h3>
	<div class = "l-material">
		
	<?php if(Yii::app()->user->hasFlash('comment')): ?>
	
	<article class = "b-transit">
		<p><?php echo Yii::app()->user->getFlash('comment'); ?></p>
	</article>
	
	<?php else: ?>
	
	<?php $this->widget('zii.widgets.CListView', array(
		'dataProvider'=>$dataProvider,
		'itemView'=>'_view',
		'template'=>"{items}{pager}",
		'ajaxUpdate'=> FALSE,
		'pager' => array(
	    	'header'=>false,
		)
		
	)); ?>
			



<div class = "g-clear_fix"></div>
<div class="form b-view_form">

<?php 

$form=$this->beginWidget('CActiveForm', array(
	'id'=>'comment-form',
	'enableClientValidation'=>false,
	'clientOptions'=>array(
		'validateOnSubmit'=>false,
	),
	'htmlOptions'=>array('enctype'=>'multipart/form-data')
)); ?>

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
		<?php echo $form->labelEx($model,'image'); 	?>
		<?php echo CHtml::activeFileField($model, 'image'); ?>
		
	</div>
	</div>
		<div class="row">
		<?php echo $form->labelEx($model,'verifyCode'); ?>
		<div>
		<?php $this->widget('CCaptcha'); ?>
		<?php echo $form->textField($model,'verifyCode'); ?>
		</div>
		<?php echo $form->error($model,'verifyCode'); ?>
	</div>
	<?php 
		echo $form->hiddenField($model,'date', array('value' => date("Y-m-d")));
		echo $form->error($model,'date');
		 
		echo $form->hiddenField($model,'is_view', array('value' => '0'));
		echo $form->error($model,'is_view');
		
		echo $form->hiddenField($model,'is_new', array('value' => '1'));
		echo $form->error($model,'is_new');
	?>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit', array('value'=>'Добавить комментарий')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<?php endif; ?>
</div>
</div>