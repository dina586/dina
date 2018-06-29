<br/>
<p class = "l-hint"><?=Yii::t('shop', 'If the buyer is registered, there will be a link on his profile in field "Buyer".');?></p>
<?php
$pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);
$this->widget('bootstrap.widgets.BsGridView', array(
	'id'=>'base_admin_grid',
	'htmlOptions' => array('class' => 'grid-view j-history_grid'),
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
			'type'=>'raw',
			'name'=>'email',
			'value'=>'"<a href = \"mailto:".$data->email."\">".$data->email."</a>"',		
		),
		array(
			'type'=>'raw',
			'name'=>'user_id',
			'value'=>'$data->user_id==0?"":Helper::userLink($data->user_id)',		
		),
		'date',
		'order_code',
		array(
			'name'=> 'status',
			'filter'=> Yii::app()->getModule('store')->orderStatus,
			'type'=>'raw',
			'value'=>'BsHtml::dropDownList("status", $data->status, Yii::app()->getModule("store")->orderStatus, array("class"=>"j-order_status"))',
		),
		array(
			'name'=>'user_comment',
			'type'=>'raw',
			'value'=>'$data->user_comment',	
		),
		array(
			'name'=>'total_cost',
			'value'=>'"$ ".StoreHelper::viewPrice($data->total_cost)',
			'htmlOptions'=>array('class'=>'l-nowrap'),
		),
		array(
			'class'=>'bootstrap.widgets.BsButtonColumn',
			'template'=>'{view}{delete}',
			'buttons'=>array(
				'print_invoice' => array(
					'label'=>'Print Invoice',     //put the span at label with icon class
					'url'=>'Yii::app()->createUrl("store/history/invoice", array("id"=>$data->id))',
					'icon'=>BsHtml::GLYPHICON_PRINT,
					'options'=>array('title'=>'Print Invoice', 'target'=>'_blank'),
				),
				'update' => array(
					'label'=>'Update Invoice',
					'url'=>'Yii::app()->createUrl("store/history/updateInvoice", array("id"=>$data->id))',
					'options'=>array('title'=>'Update Invoice', 'target'=>'_blank'),
				),
			),
			'header'=>CHtml::dropDownList('pageSize',$pageSize, Yii::app()->getModule('helper')->gridPager, array(
			'onchange'=>"$.fn.yiiGridView.update('base_admin_grid',{ data:{pageSize: $(this).val() }})",
		)),
		),
	),
)); ?>

<script type = "text/javascript">
/*Изменение роли пользователя CGridView*/
$(document).on('change', '.j-history_grid tbody .j-order_status', function() {
	var index = $('.j-history_grid tbody .j-order_status').index(this);
	var code = $('.j-history_grid tbody tr:eq('+index+') td:eq(3)').text();
	var status = $(this).val();
	$.ajax({
		url: '<?=Yii::app()->createUrl('store/history/changeStatus')?>',
		type:'POST',
		data: ({code : code, status : status}),
	})
})
</script>