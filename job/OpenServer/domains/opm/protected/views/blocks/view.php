<?php
/* @var $this BlocksController */
/* @var $model Blocks */

$this->breadcrumbs=array(
	'Blocks'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Blocks', 'url'=>array('index')),
	array('label'=>'Create Blocks', 'url'=>array('create')),
	array('label'=>'Update Blocks', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Blocks', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Blocks', 'url'=>array('admin')),
);
?>

<h1>View Blocks #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'title',
		'content',
		'position',
		'page_position',
		'is_view',
		'view_title',
	),
)); ?>
