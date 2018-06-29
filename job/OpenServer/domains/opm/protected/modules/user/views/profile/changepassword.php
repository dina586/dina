<div class="l-base_wraper">
	
	<div class = "l-page_title_wrap">
		<h1 class = "l-page_title"><?=$this->pageTitle;?></h1>
	</div>
	
	<div class = "g-clear_fix"></div>
	<div class="l-form">
	<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
		'id'=>'changepassword-form',
		'enableAjaxValidation'=>true,
		'clientOptions'=>array(
			'validateOnSubmit'=>true,
		),
	)); ?>
	
		<p class="l-note"><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>
		<?php echo $form->errorSummary($model); ?>
		
		<div class="l-row">
			<?php echo $form->passwordFieldControlGroup($model,'oldPassword'); ?>
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
		
		<div class = "g-clear_fix"></div>
	
		<?=Fields::submitBtn(Yii::t('admin','Save'), BsHtml::GLYPHICON_USER);?>
		
	<?php $this->endWidget(); ?>
	</div><!-- form -->
</div>