<div class="b-get_call_widget">
	<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
		'id'=>'b-order_form',
		'action'=>Yii::app()->createUrl('helper/default/getOrder'),
		'enableClientValidation'=>true,
			'clientOptions'=>array(
				'validateOnSubmit'=>true,
		),
	)); 
	$i = 8;
	$timeArr = [];
	for($i; $i<22; $i++) {
		$currentTime = $i.'.00 - '.($i+1).'.00';
		$timeArr[$currentTime] = $currentTime;
	}
	?>
	
	<?php echo $form->textFieldControlGroup($model,'name'); ?>

	<?php echo $form->textFieldControlGroup($model,'phone'); ?>
	
	<?=Fields::dateField($model, $form) ?>
	
	<?php echo $form->dropDownListControlGroup($model,'time', $timeArr, array('empty'=>'Любое время')); ?>
	
	<?php echo $form->textAreaControlGroup($model, 'problem'); ?>
    
	<div class = "g-clear_fix"></div>
    
	<?=Fields::submitBtn( Yii::t('main','Записаться на консультацию'), BsHtml::GLYPHICON_ENVELOPE, array('class'=>'a-get_order'));?>

	<?php $this->endWidget(); ?>
		
</div>