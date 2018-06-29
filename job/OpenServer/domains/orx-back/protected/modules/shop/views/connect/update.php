<?php
$this->breadcrumbs=array(
	'Connects'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Connect', 'url'=>array('index')),
	array('label'=>'Create Connect', 'url'=>array('create')),
	array('label'=>'View Connect', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Connect', 'url'=>array('admin')),
);
?>

<h1>Update Connect <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>