<div class ="block full l-base_grid">
	<?php
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
				'name' => 'tag',
				'value' => '"{".$data->tag."}"',
			],
			[
				'name' => 'tag_type',
				'filter' => Yii::app()->controller->module->tagType,
				'value' => 'Yii::app()->controller->module->tagType[$data->tag_type]',
			],
			[
				'class' => 'bootstrap.widgets.AdminButtonColumn',
				'template' => '{update}{delete}',
			],
		),
	));
	?>
</div>
