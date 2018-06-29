<div class ="block full l-base_grid">

<?php
	$this->widget('bootstrap.widgets.AdminGridView', [
		'id' => 'base_admin_grid',
		'dataProvider' => $model->search(),
		'filter' => $model,
		'columns' => [
			'id',
			'name',
			[
				'name' => 'is_view',
				'filter' => Yii::app()->getModule('settings')->isView,
				'value' => 'Yii::app()->getModule("settings")->isView[$data->is_view]',
			],
			[
				'name' => 'create_date',
				'value' => '$data->create_date',
				'filter'=>false,
			],
			[
				'class' => 'bootstrap.widgets.AdminButtonColumn',
				'buttons' => [
					'view' => [
						'url' => 'Helper::seoLink($data->id, get_class($data))',
					],
				],
			],
		],
	]);
?>

</div>
