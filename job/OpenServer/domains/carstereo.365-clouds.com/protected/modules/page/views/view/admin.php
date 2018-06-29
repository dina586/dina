<div class ="block full l-base_grid">
	<?php
	$template = '{view}{update}';
	if (Yii::app()->user->role == 'developer')
		$template .= '{delete}';

	$this->widget('bootstrap.widgets.AdminGridView', [
		'id' => 'base_admin_grid',
		'dataProvider' => $model->search(),
		'filter' => $model,
		'columns' => [
			'name',
			'url',
			'title',
			[
				'class' => 'bootstrap.widgets.AdminButtonColumn',
				'template'=>$template,
				'buttons' => [
					'view' => [
						'url'=>'Page::getUrl($data->id, $data->url)',
					],
				],
			],
		],
	]);
	?>
</div>
