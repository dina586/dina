<?php $this->renderPartial('helper_view.parts._toGrid', array('url'=>Yii::app()->controller->module->id.'/'.Yii::app()->controller->id.'/admin'));?>

<?php 
$pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'base_admin_grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'name',
		'url',
		'seo_title',
		'seo_description',
		'seo_keywords',
		array(
			'class'=>'CButtonColumn',
			'buttons'=>array (
				'view'=>array(
					'url'=>'Yii::app()->createUrl("shop/product/view", array("url" => $data->url))',
				),
			),
			'header'=>CHtml::dropDownList('pageSize',$pageSize,array(10=>10, 20=>20, 30=>30, 50=>50, 100=>100, 200=>200, 300=>300),array(
				'onchange'=>"$.fn.yiiGridView.update('product-grid',{ data:{pageSize: $(this).val() }})",
			)),
		),
	),
)); ?>
