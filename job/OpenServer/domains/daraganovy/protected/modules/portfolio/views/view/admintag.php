<div class ="block full l-base_grid">

<?php
	$this->widget('bootstrap.widgets.AdminGridView', [
		'id' => 'base_admin_grid',
		'dataProvider' => $model->search(),
		'filter' => $model,
		'columns' => [
			'id',
			'name',
			'frequency',
			[
				'class' => 'bootstrap.widgets.AdminButtonColumn',
				'template' => '{delete}',
				'buttons' => array(					
					'delete' => array(
						
						'url' => 'Yii::app()->createUrl("/portfolio/view/deleteTag/$data->id")',
					),
				),
				
			],
		],
	]);
?>

</div>