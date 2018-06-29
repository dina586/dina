<div class="l-form">

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>true,
	'htmlOptions' => array('enctype'=>'multipart/form-data'),
));
?>

	<p class="l-note"><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>

	<?php echo $form->errorSummary(array($model,$profile)); ?>

	<div class="l-row">
		<?php echo $form->textFieldControlGroup($model,'username',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="l-row">
		<?php echo $form->passwordFieldControlGroup($model,'password',array('size'=>60,'maxlength'=>128)); ?>
	</div>

	<div class="l-row">
		<?php echo $form->textFieldControlGroup($model,'email',array('size'=>60,'maxlength'=>128)); ?>
	</div>

	<div class="l-row">
		<?php echo $form->dropDownListControlGroup($model,'status',User::itemAlias('UserStatus')); ?>
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
			echo CHtml::activeTextAreaControlGroup($profile,$field->varname,array('rows'=>6, 'cols'=>50));
		} else {
			echo $form->textFieldControlGroup($profile,$field->varname,array('size'=>60,'maxlength'=>(($field->field_size)?$field->field_size:255)));
		}
		 ?>
	</div>
			<?php
			}
		}
?>
	<?=Fields::submitBtn($model->isNewRecord ? Yii::t('admin','Create') : Yii::t('admin','Save'));?>

<?php $this->endWidget(); ?>

</div><!-- form -->