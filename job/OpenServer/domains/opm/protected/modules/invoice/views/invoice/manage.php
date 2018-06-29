<?php 


$pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);
$this->widget('bootstrap.widgets.BsGridView', array(
	'id'=>'base_admin_grid',
	'dataProvider'=>$model->search($model),
	'filter'=>$model,
	'columns'=>array(
		array(
			'name'=>'id',
			'header'=>'№',
			'type'=>'raw',
			'value'=>'"<a target=\"_blank\" href = \"".Yii::app()->createUrl("invoice/view/view", array("id"=>$data->id))."\">".$data->id."</a>"',
		),
		array(
			'filter'=>false,
			'name'=>'create_date',
			'value'=>'$data->create_date',		
		),
		array(
			'filter'=>false,
			'name'=>'due_date',
			'value'=>'$data->due_date',
		),
		array(
			'name'=>'status',
			'filter'=>$this->module->status,
			'value'=>'Yii::app()->controller->module->status[$data->status]',		
		),
		array(
			'name'=>'total_cost',
			'value'=>'Helper::viewPrice($data->total_cost)',
		),
		array(
			'class'=>'bootstrap.widgets.BsButtonColumn',
			'template'=>'{print}{pay}',
			'buttons' => array(
				'print' => array(
					'label'=>'Print',
					'url'=>'Yii::app()->createUrl("invoice/view/view", array("id"=>$data->id))',
					'icon'=>BsHtml::GLYPHICON_PRINT,
					'options'=>array("target"=>"_blank"),
				),
				'pay' => array(
					'label'=>'Pay',
					'url'=>'Yii::app()->createUrl("invoice/invoice/pay", array("id"=>$data->id))',
					'icon'=>BsHtml::GLYPHICON_USD,
					'visible'=>'$data->status==0',
				),
			),
			'header'=>CHtml::dropDownList('pageSize',$pageSize, Yii::app()->getModule('helper')->gridPager, array(
				'onchange'=>"$.fn.yiiGridView.update('base_admin_grid',{ data:{pageSize: $(this).val() }})",
			)),
		),
	),
)); ?>
