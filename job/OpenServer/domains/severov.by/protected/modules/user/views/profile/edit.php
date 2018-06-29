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
	
		<?php echo $form->errorSummary(array($model,$profile)); ?>
	
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
		<div class="l-row">
			<?php echo $form->textFieldControlGroup($model,'username',array('size'=>60,'maxlength'=>20)); ?>
		</div>
	
		<div class="l-row">
			<?php echo $form->emailFieldControlGroup($model,'email'); ?>
		</div>
		
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