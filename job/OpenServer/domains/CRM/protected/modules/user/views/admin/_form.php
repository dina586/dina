<?php
$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
	'enableClientValidation' => true,
	'layout' => BsHtml::FORM_LAYOUT_HORIZONTAL,
	'htmlOptions' => array(
		'class' => 'form-bordered',
	),
	'clientOptions' => array(
		'validateOnSubmit' => true,
	),
		));
?>

<div class = "col-md-12">
	<?=$form->errorSummary(array($model, $profile)); ?>
</div>

<?php
$this->renderPartial('application.modules.user.views.view._base_form', ['model' => $model, 'profile' => $profile, 'form' => $form]);
?>

<div class="col-md-6">
	<div class="block last_no_border">

		<div class="block-title">
			<h2>Admin Information</h2>
		</div>

		<?php
		if ($model->status == '')
			$model->status = 1;

		echo $form->dropDownListControlGroup($model, 'status', Yii::app()->getModule('user')->status)
		?>

		<?php
		if ($model->user_role == '')
			$model->user_role = 'user';

		echo $form->dropDownListControlGroup($model, 'user_role', Roles::model()->getRoles())
		?>

		<?php
		echo $form->passwordFieldControlGroup($model, 'password', array(
			'append' => '<i class="fa fa-cog"></i>',
		));
		?>

	</div>
</div>

<div class ="clearfix"></div>

<div class ="col-md-12">
	<?=Fields::submitBtn(Yii::t('admin', 'Save and back to user list')); ?>
	<?=Fields::submitBtn(Yii::t('admin', 'Save and view profile'), 'fa fa-user', ['color' => BsHtml::BUTTON_COLOR_INFO]); ?>
</div>

<?php $this->endWidget(); ?>


