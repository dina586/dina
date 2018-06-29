<div class = "l-form">
	<?php
	$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
		'id' => 'b-quick_form',
		'action' => Yii::app()->createUrl('calendar/site/registerEvent'),
		'enableClientValidation' => true,
		'clientOptions' => array(
			'validateOnSubmit' => true,
		),
	));
	?>

	<?php Yii::app()->controller->renderPartial('application.modules.user.widgets.views._registration_fields', ['model' => $model, 'form' => $form]) ?>

	<div class = "g-clear_fix"></div>
	<input type = "hidden" name ="start_date" value ="" class = "j-calendar_start_date"/>
	<div class = "col-md-12">
		<?=Fields::submitBtn(Yii::t('main', 'Confirm'), BsHtml::GLYPHICON_ENVELOPE, ['class'=>'a-register_event']); ?>
	</div>
	<div class = "g-clear_fix"></div>

<?php $this->endWidget(); ?>
</div>

