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
			'create_date',
			[
				'class' => 'bootstrap.widgets.AdminButtonColumn',
				'template'=>'{view}{update}{beauty}{delete}',
				'buttons' => [
					'view' => [
						'url' => 'Helper::seoLink($data->id, get_class($data))',
					],
					'beauty' => [
						'url' => 'Yii::app()->createUrl("portfolio/view/beauty", ["id"=>$data->id])',
						'icon' => 'fa fa-file-image-o',
						'label' => 'Избранные фото',
					],
					
				],
			],
		],
	]);
?>

</div>