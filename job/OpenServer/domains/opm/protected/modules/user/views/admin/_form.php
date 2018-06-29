<div class="l-form">

<?php $form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
	//'layout' => BsHtml::FORM_LAYOUT_HORIZONTAL,
	'id'=>'user-form',
	'enableAjaxValidation'=>true,
	'htmlOptions' => array('enctype'=>'multipart/form-data'),
));
?>

	<p class="l-note"><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>

	<?php echo $form->errorSummary(array($model,$profile)); ?>

	<?php $this->renderPartial('/parts/_registration_form', array('model'=>$model, 'profile'=>$profile, 'form'=>$form))?>
	
	<!-- 
	<fieldset>
			
		<legend>Common information</legend>
					
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
			<?php 
			if($model->isNewRecord)
				$model->status = 1;
			echo $form->dropDownListControlGroup($model,'status',User::itemAlias('UserStatus')); ?>
		</div>
		
	</fieldset>
	 -->
	<div class = "g-clear_fix"></div>
	<div class = "l-button_wrap">
		<?=Fields::submitBtn($model->isNewRecord ? Yii::t('admin','Create') : Yii::t('admin','Save'));?>
		<?=Fields::submitBtn('Save and add Procedure', BsHtml::GLYPHICON_HAND_RIGHT, 
			array('color' => BsHtml::BUTTON_COLOR_SUCCESS
		));?>
	</div>
<?php $this->endWidget(); ?>

</div><!-- form -->