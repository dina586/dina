<div class ="block full l-base_grid">
<?php 
	$this->widget('bootstrap.widgets.AdminGridView', array(
		'id' => 'base_admin_grid',
		'dataProvider' => $model->search(),
		'filter' => $model,
		'columns' => array(
			'id',
			'name',
			'position',
			array(
				'class'=>'bootstrap.widgets.AdminButtonColumn',
			),
		),
	)); 
?>
</div>
