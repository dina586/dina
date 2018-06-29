<?php
$this->breadcrumbs=array(
	'Opinions'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Opinions', 'url'=>array('index')),
	array('label'=>'Create Opinions', 'url'=>array('create')),
	array('label'=>'Update Opinions', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Opinions', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Opinions', 'url'=>array('admin')),
);
?>

<h1>View Opinions #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'text',
		'date',
		'is_view',
	),
)); ?>
