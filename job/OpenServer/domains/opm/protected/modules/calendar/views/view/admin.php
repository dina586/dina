<?php
$pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);
$this->widget('bootstrap.widgets.BsGridView', array(
	'id'=>'base_admin_grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'name',
		array(
			'name'=>'start_date',
			'filter'=>false,
			'value'=>'$data->start_date',		
		),
		array(
			'name'=>'end_date',
			'filter'=>false,
			'value'=>'$data->end_date',		
		),
		array(
			'name'=>'worker_id',
			//'value'=>'$data->worker_id!=""&&$data->worker_id!=0?$data->worker->name:""',
			'value'=>'isset($data->worker->name)?$data->worker->name:""',
			'filter'=>CHtml::listData(CalendarWorkers::model()->findAll(array('order'=>'name')), 'id', 'name'),
		),

		array(
			'template'=>'{update}{delete}',
			'class'=>'bootstrap.widgets.BsButtonColumn',
						'header'=>CHtml::dropDownList('pageSize',$pageSize, Yii::app()->getModule('helper')->gridPager, array(
				'onchange'=>"$.fn.yiiGridView.update('base_admin_grid',{ data:{pageSize: $(this).val() }})",
			)),
		),
	),
)); ?>
