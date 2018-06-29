<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
	'id'=>'a-user_form',
)); ?>

	<div class="col-md-3">
		<?php echo $form->textFieldControlGroup($model,'s_name'); ?>
	</div>

	<div class="col-md-3">
		<?php echo $form->textFieldControlGroup($model,'s_phone', array('class' => 'j-phone_field')); ?>
	</div>

	<div class="col-md-3">
		<?php echo $form->textFieldControlGroup($model,'s_email'); ?>
	</div>
	
	<div class="col-md-3">
		<?php
		echo $form->dropDownListControlGroup(
			$model,
			's_city',
			System::getCities('Profile'),
			array('empty'=>Yii::t('user', 'Choose City'))
		);
		?>
		
	</div>

	<div class ="g-clear_fix"></div>
	
	<hr/>
	
	<div class ="g-clear_fix"></div>
	
	<?php
		$this->widget('application.modules.user.widgets.ProfileTypeWidget', array('userId' => false, 'viewFilters'=>true));
	?>
	
	<div class ="g-clear_fix"></div>
	
	<hr/>
	
	<div class="row buttons">
		<?php echo BsHtml::submitButton('Search', array(
			'color' => BsHtml::BUTTON_COLOR_SUCCESS,
			'size' => BsHtml::BUTTON_SIZE_DEFAULT,
		)); ?>
		|
		<?=Helper::linkButton('Refresh', Yii::app()->createUrl('user/admin/list'), array('color' => BsHtml::BUTTON_COLOR_SUCCESS))?>
	</div>

<?php $this->endWidget(); ?>

