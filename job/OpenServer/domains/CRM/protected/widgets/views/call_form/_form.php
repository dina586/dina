<?php 
//Yii::app()->clientScript->registerPackage('mask');
JS::add('mobilemask', '$(".j-mobile_field").mask("+375(99) 999-99-99");
;');
?>
<div class="b-get_call_form">
	<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
		'id'=>$id,
		'action'=>Yii::app()->createUrl('helper/default/getCall'),
		'enableClientValidation'=>true,
			'clientOptions'=>array(
				'validateOnSubmit'=>true,
		),
	)); 
	?>
	<div class = "b-get_call_form_header">
		<header>Оставьте заявку</header>
		<p>чтобы получить консультацию </p>
		<p>от нашего специалиста бесплатно<p>
	</div>
	
	<div class = "b-form_row b-site_form_name">
		<?php echo $form->textFieldControlGroup($model,'name', ['placeholder'=>'Ваше имя']); ?>
	</div>
	
	<div class = "b-form_row b-site_form_phone">
		<?php echo $form->textFieldControlGroup($model,'phone', ['placeholder'=>'Ваш телефон', 'class'=>'j-mobile_field', 'value'=>'+375 __ ___-__-__']); ?>
    </div>
	
	<div class = "g-clear_fix"></div>
    
	<div class = "b-form_btn">
		<button class = "l-order_btn <?=$class;?>">Отправить заявку</button>
	</div>
	
	<?php if ($class == 'a-button')
		echo '<div class = "d-content"></div>';
	?>

	<?php $this->endWidget(); ?>
		
</div>