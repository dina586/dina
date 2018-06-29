<?php 
$this->renderPartial('application.modules.invoice.views.view._filter',array('model'=>$model));

$pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);
$this->widget('bootstrap.widgets.BsGridView', array(
	'id'=>'base_admin_grid',
	'dataProvider'=>$model->search($model),
	'columns'=>array(
		array(
			'name'=>'id',
			'type'=>'raw',
			'value'=>'"<a target=\"_blank\" href = \"".Yii::app()->createUrl("invoice/view/view", array("id"=>$data->id))."\">".$data->id."</a>"',
		),
		array(
			'name'=>'invoice_type',
			'header'=>'Name',
			'value'=>'InvoiceHelper::invoiceName($data)',	
		),
		array(
			'name'=>'name',
			'header'=>'Buyer',
			'value'=>'$data->name',
		),
		array(
			'filter'=>false,
			'name'=>'create_date',
			'value'=>'$data->create_date',		
		),
		array(
			'name'=>'tax',
			'value'=>'"$ ".Helper::viewPrice($data->tax)',
		),
		array(
			'name'=>'shipping',
			'value'=>'"$ ".Helper::viewPrice($data->shipping==""?0:$data->shipping)',
		),
		
		array(
			'name'=>'total_cost',
			'value'=>'"$ ".Helper::viewPrice($data->total_cost)',
		),
		array(
			'name'=>'status',
			'filter'=>$this->module->status,
			'value'=>'Yii::app()->controller->module->status[$data->status]',
		),
		array(
			'filter'=>false,
			'name'=>'due_date',
			'value'=>'$data->due_date',
		),
		array(
			'class'=>'bootstrap.widgets.BsButtonColumn',
			'template'=>'{pay}{print}{update}{delete}',
			'buttons' => array(
				'print' => array(
					'label'=>'Print',
					'url'=>'Yii::app()->createUrl("invoice/view/view", array("id"=>$data->id))',
					'icon'=>BsHtml::GLYPHICON_PRINT,
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
