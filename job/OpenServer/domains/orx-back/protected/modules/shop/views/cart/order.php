<div class = "b-about">
	<h3 class = "page_title">Корзина</h3>
	<div class = "l-material">
		<div class = "b-cart">
<?php if(Yii::app()->user->hasFlash('cart')): ?>
	<?php 
		$block = Block::viewBlock(8);
		foreach($block as $view){
			echo $view['description'];
			echo '<div class = "g-clear_fix"></div>';
		}
	?>

<?php else: 
if($position = Yii::app()->shoppingCart->isEmpty(1) == true):?>
<article class = "b-transit">
	<p>Ваша корзина пуста! Посетите магазин!</p>
</article>
<?php 
else : ?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cart-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name', array('size'=>60)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email', array('size'=>60)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<?php echo $form->hiddenField($model,'subject',array('size'=>60,'maxlength'=>128, 'value' => 'Заказ с сайта')); ?>
	<div class="row">
		<?php echo $form->labelEx($model,'address'); ?>
		<?php echo $form->textField($model,'address', array('size'=>60)); ?>
		<?php echo $form->error($model,'address'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'phone'); ?>
		<?php echo $form->textField($model,'phone',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'phone'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'body'); ?>
		<?php echo $form->textArea($model,'body',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'body'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit', array('value'=>'Отправить заказ')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<?php endif; endif; ?>

</div>
</div>
</div>
