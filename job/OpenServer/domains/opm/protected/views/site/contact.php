<div class="l-base_wraper">
	
	<div class = "l-page_title_wrap">
		<h1 class = "l-page_title"><?=$content->name;?></h1>
	</div>
	
	<div class = "g-clear_fix"></div>
	
	<article class = "g-styles">
		<?=$content->content;?>
	</article>
	<br/><br/><br/>
	
	<iframe src="https://www.google.com/maps/embed?pb=!1m24!1m12!1m3!1d3304.7000941787055!2d-118.47137856931154!3d34.0772014813525!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m9!1i0!3e6!4m0!4m5!1s0x80c2bcc6b3929601%3A0x4ffe1ddf41ef57ca!2s651+N+Sepulveda+Blvd%2C+Los+Angeles%2C+CA+90049!3m2!1d34.0772015!2d-118.4692328!5e0!3m2!1sen!2sus!4v1428308192341" width="600" height="450" frameborder="0" style="border:0"></iframe>
	
	<?php if(Yii::app()->user->hasFlash('contact')): ?>
	
		<div class="l-system_message">
			<?php echo Yii::app()->user->getFlash('contact'); ?>
		</div>
	
	<?php endif; ?>
		
	<div class="l-form">
		
		<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
		'id'=>'contact-form',
		'enableClientValidation'=>false,
			'clientOptions'=>array(
			'validateOnSubmit'=>false,
		),
	)); 
	?>
		<div class="l-row">
			<?php echo $form->textFieldControlGroup($model,'name'); ?>
		</div>
		
		<div class="l-row">
			<?php echo $form->emailFieldControlGroup($model,'email'); ?>
		</div>
		
		<div class="l-row">
			<?php echo $form->textFieldControlGroup($model,'subject'); ?>
		</div>
		
		<div class="l-row">
			<?php echo $form->textAreaControlGroup($model,'message'); ?>
		</div>
			
		<?php $this->renderPartial('helper_view.parts._captcha', array('model'=>$model, 'form'=>$form, 'field'=>'verifyCode'));?>
			
		<div class = "g-clear_fix"></div>
					
		<?=Fields::submitBtn( Yii::t('main','Send'), BsHtml::GLYPHICON_ENVELOPE);?>
	
	<?php $this->endWidget(); ?>
		
	</div><!-- l-form -->
</div>
<?=Helper::editLink(Yii::app()->createUrl('page/view/update', array('id'=>$content->id)));?>
