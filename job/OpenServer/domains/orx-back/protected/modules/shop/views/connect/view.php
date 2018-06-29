<?php
$this->breadcrumbs=array(
	'Connects'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Connect', 'url'=>array('index')),
	array('label'=>'Create Connect', 'url'=>array('create')),
	array('label'=>'Update Connect', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Connect', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Connect', 'url'=>array('admin')),
);
?>

<h1>View Connect #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'catalog_id',
		'product_id',
	),
)); ?>
