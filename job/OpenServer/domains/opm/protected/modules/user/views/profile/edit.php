<div class="l-base_wraper">
	
	<div class = "l-page_title_wrap">
		<h1 class = "l-page_title"><?=$this->pageTitle;?></h1>
	</div>
	
	<div class = "g-clear_fix"></div>
	
	<div class="l-form">
	<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
		'id'=>'profile-form',
		'enableAjaxValidation'=>true,
		'htmlOptions' => array('enctype'=>'multipart/form-data'),
	)); ?>
	
		<p class="l-note"><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>
	
		<fieldset>
			
			<legend>Common information</legend>
				
			<div class="l-row">
				<?php echo $form->emailFieldControlGroup($model,'email'); ?>
			</div>
			
			<div class="l-row">
				<?php echo $form->textFieldControlGroup($model,'username'); ?>
			</div>
			
		</fieldset>
		
		<fieldset>
			
			<legend>Name</legend>
			
			<div class="l-row">
				<?php echo $form->textFieldControlGroup($profile,'firstname'); ?>
			</div>
			
			<div class="l-row">
				<?php echo $form->textFieldControlGroup($profile,'lastname'); ?>
			</div>
			
		</fieldset>
		
		<fieldset>
			
			<legend>Address</legend>
			
			<div class="l-row">
				<?php echo $form->textFieldControlGroup($profile,'address'); ?>
			</div>
			
			<div class="l-row">
				<?php echo $form->textFieldControlGroup($profile,'apartments'); ?>
			</div>
			
			<div class="l-row">
				<?php echo Fields::countryAdmin($profile, $form);?>
			</div>
			
			<div class="l-row d-choosen_city">
				<?php echo Fields::cityAdmin($profile, $form) ?>
			</div>
			
			<div class="l-row">
				<?php echo $form->textFieldControlGroup($profile,'zip'); ?>
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
				<?php echo $form->dropDownListControlGroup($profile,'here_about', $this->module->hear, array('empty'=>'Other')); ?>
			</div>
			
		</fieldset>
		
		<div class="l-row l-form_image">
			<?php echo $form->labelEx($model,'image'); 	?>
			<?php echo $form->fileField($model, 'image');?>
			<br/><?=Yii::app()->user->avatar();?>
		</div>
		
		<div class = "g-clear_fix"></div>
		
		<?=Fields::submitBtn( Yii::t('admin','Save'));?>
	
	<?php $this->endWidget(); ?>
	
	</div><!-- l-form -->
</div>