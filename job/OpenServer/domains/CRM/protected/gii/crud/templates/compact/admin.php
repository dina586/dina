<div class ="block full l-base_grid">
<?php echo "<?php \n";?>
	$this->widget('bootstrap.widgets.AdminGridView', array(
		'id' => 'base_admin_grid',
		'dataProvider' => $model->search(),
		'filter' => $model,
		'columns' => array(
<?php
$count=0;
$hasUrl = false;
foreach($this->tableSchema->columns as $column)
{
	if(++$count==7)
		echo "\t\t\t/*\n";
	echo "\t\t\t'".$column->name."',\n";
	if($column->name == 'url')
		$hasUrl = true;
}
if($count>=7)
	echo "\t\t\t*/\n";
?>
			array(
				'class'=>'bootstrap.widgets.AdminButtonColumn',
			),
		),
	)); 
?>
</div>
