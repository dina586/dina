<div class="l-base_wraper">
	<div class = "l-page_title_wrap">
		<h1 class = "l-page_title"><?=$this->pageTitle;?></h1>
	</div>
	
	<div class = "g-clear_fix"></div>

	<?php if(Yii::app()->user->hasFlash('registration')): ?>
		
		<div class="l-system_message">
			<?php echo Yii::app()->user->getFlash('registration'); ?>
		</div>
	
	<?php else: ?>
	
	<div class="l-form">
	<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
		'id'=>'registration-form',
		'clientOptions'=>array(
		),
		'htmlOptions' => array('enctype'=>'multipart/form-data'),
	)); ?>
	
		<p class="note"><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>
		
		<?php echo $form->errorSummary(array($model,$profile)); ?>
		
		<fieldset>
			
			<legend>Common information</legend>
				
			<div class="l-row">
				<?php echo $form->emailFieldControlGroup($model,'email'); ?>
			</div>
			
			<div class="l-row">
				<?php echo $form->textFieldControlGroup($model,'username'); ?>
			</div>
			
			<div class="l-row">
				<?php echo $form->passwordFieldControlGroup($model,'password'); ?>
				<p class="l-hint">
					<?php echo UserModule::t("Minimal password length 4 symbols."); ?>
				</p>
			</div>
			
			<div class="l-row">
				<?php echo $form->passwordFieldControlGroup($model,'verifyPassword'); ?>
			</div>
		
		</fieldset>
		

		
		
		
		<fieldset>
			
			<legend>Contacts</legend>
			
			<div class="l-row">
				<?php echo $form->textFieldControlGroup($profile,'mobile', array('class'=>'j-phone_field')); ?>
			</div>
			
			<div class="l-row">
				<?php echo $form->dropDownListControlGroup($profile,'carriers', $this->module->carriers); ?>
			</div>
			
		</fieldset>
		
		<fieldset>
			
			<legend>How did you hear about us</legend>
						
			<div class="l-row">
				<?php 
				echo $form->dropDownListControlGroup($profile,'here_about', $this->module->hear, array('empty'=>'Other')); ?>
			</div>
			
		</fieldset>
		

		<?php if (UserModule::doCaptcha('registration')): ?>
			<?php $this->renderPartial('helper_view.parts._captcha', array('model'=>$model, 'form'=>$form, 'field'=>'verifyCode'));?>
		<?php endif; ?>
		
		<div class = "g-clear_fix"></div>
		
		<?=Fields::submitBtn( UserModule::t("Register"), BsHtml::GLYPHICON_REGISTRATION_MARK);?>
		
		<?php $this->endWidget(); ?>
	</div><!-- l-form -->
	<?php endif; ?>
</div>