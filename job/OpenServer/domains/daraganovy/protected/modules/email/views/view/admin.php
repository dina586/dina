<div class ="block full l-base_grid">
	<?php
	if (Yii::app()->user->checkAccess("developer"))
		$template = '{update}{delete}';
	else
		$template = '{update}';

	$this->widget('bootstrap.widgets.AdminGridView', array(
		'id' => 'base_admin_grid',
		'dataProvider' => $model->search(),
		'filter' => $model,
		'columns' => array(
			[
				'name' => 'name',
				'value' => 'Yii::t("admin", $data->name)',
			],
			[
				'name' => 'subject',
				'value' => 'Yii::t("admin", $data->subject)',
			],
			[
				'name' => 'email_type',
				'filter' => Yii::app()->controller->module->emailFor,
				'value' => 'Yii::app()->controller->module->emailFor[$data->email_type]',
			],
			[
				'name' => 'email_key',
				'value' => '$data->email_key',
				'visible' => Yii::app()->user->checkAccess("developer"),
			],
			[
				'class' => 'bootstrap.widgets.AdminButtonColumn',
				'template' => $template,
			],
		),
	));
	?>
</div>