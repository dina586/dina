<div class ="block full l-base_grid">
<div class = "l-form">
	<?=Helper::linkButton('Create new', Yii::app()->createUrl('/'.Yii::app()->controller->module->id.'/'.Yii::app()->controller->id.'/create'));?>
</div>
<?php
	$this->widget('bootstrap.widgets.AdminGridView', [
		'id' => 'base_admin_grid',
		'dataProvider' => $model->search(),
		'filter' => $model,
		'columns' => [
			'id',
			'content',
			[
				'name' => 'is_view',
				'filter' => Yii::app()->getModule('settings')->isView,
				'value' => 'Yii::app()->getModule("settings")->isView[$data->is_view]',
			],
			
			array(
			'class' => 'bootstrap.widgets.AdminButtonColumn',
                                'template' => '{update}{delete}',
			
			),
		],
	]);
?>

</div>
