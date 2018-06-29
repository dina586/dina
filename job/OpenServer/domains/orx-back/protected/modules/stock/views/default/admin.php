<h3>Управление Акциями</h3>



<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'block-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'name',
		'date',
		array(
			'name'=> 'is_view',
			'filter'=> array('1'=>'Активна', '0' => 'Не активна'),
			'value'=>'$data->adminSearchIsView($data->is_view)',
		),
		array(
			'name'=> 'refresh',
			'filter'=> array('1'=>'Да', '0' => 'Нет'),
			'value'=>'$data->adminSearchRefresh($data->refresh)',
		),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
