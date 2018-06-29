<?php
$this->breadcrumbs=array(
	'Products',
);

$this->menu=array(
	array('label'=>'Create Product', 'url'=>array('create')),
	array('label'=>'Manage Product', 'url'=>array('admin')),
);
?>

<h1>Products</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
	'template'=>"{items}{pager}",
	'ajaxUpdate'=> FALSE,
	'pager' => array(
    	'header'=>false,
		'prevPageLabel'=>'',
		'nextPageLabel'=>'',
	)
)); ?>
