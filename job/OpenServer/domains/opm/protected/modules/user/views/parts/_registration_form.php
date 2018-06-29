<fieldset class = "col-md-6">

	<legend>Client info</legend>

	<div class="l-row">
		<?php echo $form->textFieldControlGroup($profile, 'firstname'); ?>
	</div>

	<div class="l-row">
		<?php echo $form->textFieldControlGroup($profile, 'lastname'); ?>
	</div>

	<div class="l-row">
		<?php echo Fields::birthdayField($profile, $form) ?>
	</div>

</fieldset>

<fieldset class = "col-md-6">

	<legend>Address</legend>

	<div class="l-row">
		<?php echo $form->textFieldControlGroup($profile, 'address'); ?>
	</div>

	<div class="l-row">
		<?php echo $form->textFieldControlGroup($profile, 'apartments'); ?>
	</div>

	<div class="l-row">
		<?php echo Fields::countryAdmin($profile, $form); ?>
	</div>

	<div class="l-row d-choosen_state">
		<?php echo Fields::stateAdmin($profile, $form) ?>
	</div>

	<div class="l-row d-choosen_city">
		<?php echo Fields::cityAdmin($profile, $form) ?>
	</div>

	<div class="l-row">
		<?php echo $form->textFieldControlGroup($profile, 'zip'); ?>
	</div>

</fieldset>

<fieldset class = "col-md-6">

	<legend>Contacts</legend>

	<div class="l-row">
		<?php echo $form->emailFieldControlGroup($model, 'email'); ?>
	</div>

	<div class="l-row">
		<?php echo $form->textFieldControlGroup($profile, 'mobile', array('class' => 'j-phone_field')); ?>
	</div>

	<div class="l-row">
		<?php
		if ($profile->isNewRecord)
			$profile->carriers = '';
		echo $form->dropDownListControlGroup($profile, 'carriers', $this->module->carriers, array('empty' => 'No information'));
		?>
	</div>

	<div class="l-row">
<?php echo $form->textFieldControlGroup($profile, 'emergency_phone', array('class' => 'j-phone_field')); ?>
	</div>

</fieldset>

<fieldset class = "col-md-6">

	<legend>Occupation</legend>

	<div class="l-row">
<?= Fields::textArea($profile, $form, 'occupation'); ?>
	</div>

</fieldset>



<fieldset class = "col-md-6">

	<legend>How did you hear about us</legend>

	<div class="l-row">
		<?php
		if ($profile->isNewRecord)
			$profile->here_about = '';
		echo $form->dropDownListControlGroup($profile, 'here_about', $this->module->hear, array('empty' => 'Other'));
		?>
	</div>

	<div class="l-row">
<?php echo $form->textFieldControlGroup($profile, 'friend_name'); ?>
		<p class = "l-hint">He will get a gift</p>
	</div>

</fieldset>

<fieldset class = "col-md-6">

	<legend>Notes</legend>

	<div class="l-row">
<?= Fields::textArea($profile, $form, 'notes'); ?>
	</div>

</fieldset>

<div class ="g-clear_fix"></div>

<div class = "row">
	<div class ="panel panel-default">
		<div class ="panel-heading">
			<h4 class ="panel-title">Client Services</h4>
		</div>
		<div class = "panel-body">
			<?php
				$this->widget('application.modules.user.widgets.ProfileTypeWidget', array('userId' => $model->id));
			?>
		</div>
	</div>
</div>

<div class ="g-clear_fix"></div>

<fieldset class = "col-md-12">

	<legend>Upload photo</legend>

	<?php
	$id = $model->isNewRecord ? -1 : $model->id;
	$this->widget('file_uploader.UploadWidget', array(
		'postParams' => array(
			'thumbnail' => array('width' => 100, 'height' => 100),
			'medium' => array('width' => 200, 'height' => 150),
			'id' => $id,
			'name' => get_class($model),
			'file_type' => 'image',
		),
	));
	$this->widget('file_uploader.FormWidget', array('id' => $id, 'modelName' => get_class($model)));
	?>


</fieldset>
