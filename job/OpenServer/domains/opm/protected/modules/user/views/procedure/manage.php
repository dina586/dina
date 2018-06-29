<div class = "g-clear_fix"></div>
<a class="btn btn-success btn-block" href="<?=Yii::app()->createUrl('user/procedure/create', array('user_id'=>$service->user_id))?>">
	<span class="fa fa-plus"></span> Add new procedure
</a>
<div class = "g-clear_fix"></div>

<?php 

$pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);
$this->widget('bootstrap.widgets.BsGridView', array(
	'id'=>'base_admin_grid',
	'dataProvider'=>$service->search(),
	'filter'=>$service,
	'columns'=>array(
		array(
			'name'=>'procedure_id',
			'value'=>'$data->procedure->name',
		),
		array(
			'name'=>'service_id',
			'value'=>'$data->service->name',
		),
		'price',
		array(
			'name'=>'is_visit',
			'value'=>'$data->isVisit[$data->is_visit]',
			'filter'=>$service::model()->isVisit,
		),
		'visit_date',
		array(
			'class'=>'bootstrap.widgets.BsButtonColumn',
			'template'=>'{print}{update}{delete}',
			'buttons'=>array(
				'print' => array(
					'label'=>'print',     //put the span at label with icon class
					'url'=>'Yii::app()->createUrl("service/view/contract", array("user_id"=>$data->user_id, "service_id"=>$data->service_id))',
					'icon'=>BsHtml::GLYPHICON_PRINT,
					'options'=>array('title'=>'Print Contract', 'target'=>'_blank'), // put here the title to show when mouse over
				),
				'update' => array(
					'url'=>'Yii::app()->createUrl("user/procedure/update", array("id"=>$data->id))',
				),
				'delete' => array(
					'url'=>'Yii::app()->createUrl("user/procedure/delete", array("id"=>$data->id))',
				),
			),
			'header'=>CHtml::dropDownList('pageSize',$pageSize, Yii::app()->getModule('helper')->gridPager, array(
				'onchange'=>"$.fn.yiiGridView.update('base_admin_grid',{ data:{pageSize: $(this).val() }})",
			)),
		),
	),
)); ?>