<?php
$this->breadcrumbs=array(
	'Connects'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Connect', 'url'=>array('index')),
	array('label'=>'Manage Connect', 'url'=>array('admin')),
);
?>

<h1>Create Connect</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>