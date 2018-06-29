<div class="b-get_call_widget">
	<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
		'id'=>'b-call_form',
		'action'=>Yii::app()->createUrl('helper/default/getCall'),
		'enableClientValidation'=>true,
			'clientOptions'=>array(
				'validateOnSubmit'=>true,
		),
	)); 
	?>
	
	<?php echo $form->textFieldControlGroup($model,'name'); ?>

	<?php echo $form->textFieldControlGroup($model,'phone'); ?>
    
	<div class = "g-clear_fix"></div>
    
	<?=Fields::submitBtn( Yii::t('main','Заказать звонок'), BsHtml::GLYPHICON_ENVELOPE, array('class'=>'a-get_call'));?>

	<?php $this->endWidget(); ?>
		
</div>