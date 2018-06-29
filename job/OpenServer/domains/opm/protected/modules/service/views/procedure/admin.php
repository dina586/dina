<?php 

$pageSize=Yii::app()->user->getState('pageSize', 50);
$this->widget('bootstrap.widgets.BsGridView', array(
	'id'=>'base_admin_grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
			'name'=>'service_id',
			'value'=>'$data->service->name',
			'filter'=>CHtml::listData(Service::model()->findAll(array('order'=>'name')), 'id', 'name'),
		),
		'name',
		'number',
		array(
			'name'=>'price',
			'value'=>'Helper::viewPrice($data->price)',	
		),
		'days',
		'procedure_length',
		array(
			'class'=>'bootstrap.widgets.BsButtonColumn',
			'template'=>'{update}{delete}',
			'header'=>CHtml::dropDownList('pageSize',$pageSize, Yii::app()->getModule('helper')->gridPager, array(
				'onchange'=>"$.fn.yiiGridView.update('base_admin_grid',{ data:{pageSize: $(this).val() }})",
			)),
		),
	),
)); ?>
