<div class="b-front_form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'order-form',
	'enableClientValidation'=>true,
	'action'=>Yii::app()->createUrl('/helper/default/getOrder'),
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); 
?>
	<div class="b-row">
		<?php echo $form->textField($model,'name', array('placeholder'=>'Имя')); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="b-row">
		<?php echo $form->textField($model,'phone', array('placeholder'=>'Телефон')); ?>
		<?php echo $form->error($model,'phone'); ?>
	</div>

	<div class="b-row">
		<?php echo $form->textField($model,'email',array('placeholder'=>'E-mail')); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>
	
	<div class="b-row">
		<?php echo $form->textField($model,'company',array('placeholder'=>'Компания')); ?>
		<?php echo $form->error($model,'company'); ?>
	</div>
	
	<p>Оставьте заявку и организаторы свяжутся с Вами в течение 24 часов.</p>
	
	<div class = "d-content"></div>
	
	<div class = "b-form_btn">
		<button class = "a-button">Отправить заявку</button>
	</div>
	
<?php $this->endWidget(); ?>

</div><!-- form -->

