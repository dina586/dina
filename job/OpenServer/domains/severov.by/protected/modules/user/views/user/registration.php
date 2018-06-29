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
		//'enableAjaxValidation'=>true,
		//'disableAjaxValidationAttributes'=>array('RegistrationForm_verifyCode'),
		'clientOptions'=>array(
			//'validateOnSubmit'=>true,
		),
		'htmlOptions' => array('enctype'=>'multipart/form-data'),
	)); ?>
	
		<p class="note"><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>
		
		<?php echo $form->errorSummary(array($model,$profile)); ?>
	
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
		
		<div class="l-row">
			<?php echo $form->emailFieldControlGroup($model,'email'); ?>
		</div>
		
		<?php 
			$profileFields=$profile->getFields();
			if ($profileFields) {
				foreach($profileFields as $field) {
				?>
					<div class="l-row">
						<?php 			
						if ($widgetEdit = $field->widgetEdit($profile)) {
							echo $widgetEdit;
						} elseif ($field->range) {
							echo $form->dropDownListControlGroup($profile,$field->varname,Profile::range($field->range));
						} elseif ($field->field_type=="TEXT") {
							echo $form->textAreaControlGroup($profile,$field->varname,array('rows'=>6, 'cols'=>50));
						} else {
							echo $form->textFieldControlGroup($profile,$field->varname,array('size'=>60,'maxlength'=>(($field->field_size)?$field->field_size:255)));
						}
						?>
					</div>	
				<?php
				}
			}
		?>
		<?php if (UserModule::doCaptcha('registration')): ?>
			<?php $this->renderPartial('helper_view.parts._captcha', array('model'=>$model, 'form'=>$form, 'field'=>'verifyCode'));?>
		<?php endif; ?>
		
		<div class = "g-clear_fix"></div>
		
		<?=Fields::submitBtn( UserModule::t("Register"), BsHtml::GLYPHICON_REGISTRATION_MARK);?>
		
		<?php $this->endWidget(); ?>
	</div><!-- l-form -->
	<?php endif; ?>
</div>