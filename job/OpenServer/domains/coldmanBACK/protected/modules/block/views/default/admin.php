<div class ="block full l-base_grid">
	<?php
	$this->widget('bootstrap.widgets.AdminGridView', array(
		'id' => 'base_admin_grid',
		'dataProvider' => $model->search(),
		'filter' => $model,
		'columns' => array(
			'id',
			'name',
			'title',
			'position',
			[
				'name' => 'page_position',
				'filter' => Yii::app()->getModule('block')->namespace,
				'value' => 'Yii::app()->getModule("block")->namespace[$data->page_position]',
			],
			[
				'name' => 'is_view',
				'filter' => Yii::app()->getModule('settings')->isView,
				'value' => 'Yii::app()->getModule("settings")->isView[$data->is_view]',
			],
			[
				'name' => 'view_title',
				'filter' => Yii::app()->getModule('settings')->isView,
				'value' => 'Yii::app()->getModule("settings")->isView[$data->view_title]',
			],
			[
				'class' => 'bootstrap.widgets.AdminButtonColumn',
				'template' => '{update}{delete}',
			],
		)
	));
	?>
</div>
