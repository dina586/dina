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

<h3>Управление статьями</h3>



<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'about-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'name',
		'brief_descr',
		'date',
		'position',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
