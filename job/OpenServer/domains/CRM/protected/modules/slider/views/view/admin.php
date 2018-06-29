<div class ="block full l-base_grid">

<?php
$this->widget('bootstrap.widgets.AdminGridView', array(
	'id' => 'base_admin_grid',
	'dataProvider' => $model->search(),
	'filter' => $model,
	'columns' => array(
		array(
			'name' => 'image',
			'type' => 'raw',
			'filter' => '',
			'value' => '"<div style = \"background: #000\">".Fields::gridImage("/upload/".Yii::app()->controller->module->folder."/".$data->img_name)."</div>"',
			'htmlOptions' => array('class' => 'l-align_center l-grid_cover_column'),
			'header' => Yii::t('main', 'Image'),
		),
		'id',
		'name',
		array(
			'name' => 'position',
			'value' => '$data->position',
		),
		array(
			'class' => 'bootstrap.widgets.AdminButtonColumn',
			'template' => '{update}{delete}',
		),
	),
));
?>
</div>