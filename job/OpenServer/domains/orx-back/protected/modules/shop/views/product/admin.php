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

<h3>Управление товарами</h3>


<?php echo CHtml::link('Расширенный поиск','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<?php $this->renderPartial('helper_view.parts._toSeo', array('url'=>Yii::app()->controller->module->id.'/'.Yii::app()->controller->id.'/seo'));?>

<?php 
$pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'product-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'name',
		'price',
		'share_price',
		'date',
		'position',
		array(
			'name'=> 'is_view',
			'filter'=> array('1'=>'Отображается', '0' => 'Скрыт'),
			'value'=>'$data->adminSearchIsView($data->is_view)',
		),
		array(
			'name'=> 'in_stock',
			'filter'=> array('0' => 'Нет', '1'=>'Учавствует'),
			'value'=>'$data->adminSearchInStock($data->in_stock)',
		),
		array(
			'name'=> 'popular',
			'filter'=> array('1'=>'Отображается', '0' => 'Нет'),
			'value'=>'$data->adminSearchSliderView($data->popular)',
		),
		array(
			'name'=> 'top_season',
			'filter'=> array('1'=>'Выводится', '0' => 'Не отображается'),
			'value'=>'$data->adminSearchTopSeason($data->top_season)',
		),
		array(
			'name'=> 'new',
			'filter'=> array('1'=>'Да', '0' => 'Нет'),
			'value'=>'$data->adminSearchNew($data->new)',
		),
		//'catalog_id',
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
