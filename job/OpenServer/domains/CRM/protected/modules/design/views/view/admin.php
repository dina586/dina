<div class ="block full l-base_grid">
<?php 
	$this->widget('bootstrap.widgets.AdminGridView', array(
		'id' => 'base_admin_grid',
		'dataProvider' => $model->search(),
		'filter' => $model,
		'columns' => array(
			'id',
			'name',
			[
				'name'=>'catalog_id',
				'value'=>'Yii::app()->getModule("design")->catalog[$data->catalog_id]',
				'filter'=>$this->module->catalog,
			],
			'position',
			array(
				'template' =>'{update}{delete}',
				'class'=>'bootstrap.widgets.AdminButtonColumn',
			),
		),
	)); 
?>
</div>
