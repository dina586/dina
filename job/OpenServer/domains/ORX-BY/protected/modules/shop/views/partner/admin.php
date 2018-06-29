<?php
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('about-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h3>Управление слайдером "НАШИ партнеры"</h3>



<?php 
$pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'product-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'name',
		'position',
		array(
			'name'=> 'is_view',
			'filter'=> array('1'=>'Отображается', '0' => 'Скрыт'),
			'value'=>'$data->adminSearchIsView($data->is_view)',
		),
		
		array(
			'class'=>'CButtonColumn',
			'buttons'=>array (
				'view'=>array(
					'url'=>'Yii::app()->createUrl("site/index")',
				),
			),
			'header'=>CHtml::dropDownList('pageSize',$pageSize,array(10=>10, 20=>20, 30=>30, 50=>50, 100=>100, 200=>200, 300=>300),array(
				'onchange'=>"$.fn.yiiGridView.update('product-grid',{ data:{pageSize: $(this).val() }})",
			)),
		),
	),
)); ?>
