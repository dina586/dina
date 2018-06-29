<div class="l-row l-captcha">
	<?php echo $form->labelEx($model,$field); ?>
		
	<?php $this->widget('CCaptcha'); ?>
	<br/>
	<?php echo $form->textField($model, $field); ?>
		
	<div class = "g-clear_fix"></div>
		
	<?php echo $form->error($model, $field); ?>
		
	<p class="l-hint"><?php echo Yii::t('main', "Please enter the result obtained from the expression"); ?></p>
</div>