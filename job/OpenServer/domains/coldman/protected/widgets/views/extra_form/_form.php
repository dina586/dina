<div class="b-get_extra_widget">
	<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
		'id'=>'b-extra_form',
		'action'=>Yii::app()->createUrl('helper/default/getExtra'),
		'enableClientValidation'=>true,
			'clientOptions'=>array(
				'validateOnSubmit'=>true,
		),
	)); 
	?>
	
	<?php echo $form->textFieldControlGroup($model,'name'); ?>

	<?php echo $form->textFieldControlGroup($model,'phone'); ?>
	
	<?php echo $form->textFieldControlGroup($model,'email'); ?>
	
	<?php echo $form->textFieldControlGroup($model,'company'); ?>
    
	<div class = "g-clear_fix"></div>
    
	<div class = "b-form_btn">
		<button class = "a-get_extra">Отправить заявку</button>
	</div>

	<?php $this->endWidget(); ?>
		
</div>