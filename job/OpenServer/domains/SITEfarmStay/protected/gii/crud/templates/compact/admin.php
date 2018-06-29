<?php echo "<?php\n"?>$pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);
$this->widget('bootstrap.widgets.BsGridView', array(
	'id'=>'base_admin_grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
<?php
$count=0;
$hasUrl = false;
foreach($this->tableSchema->columns as $column)
{
	if(++$count==7)
		echo "\t\t/*\n";
	echo "\t\t'".$column->name."',\n";
	if($column->name == 'url')
		$hasUrl = true;
}
if($count>=7)
	echo "\t\t*/\n";
?>
		array(
			'class'=>'bootstrap.widgets.BsButtonColumn',
			<?php if($hasUrl){
			echo "'buttons'=>array (
				'view'=>array(
					'url'=>'Yii::app()->createUrl(\"'.Yii::app()->controller->module->id.'/'.Yii::app()->controller->id.'/view\",array(\"url\" => \$data->url))',
				),
			),\n";
			};?>
			'header'=>CHtml::dropDownList('pageSize',$pageSize, Yii::app()->getModule('helper')->gridPager, array(
				'onchange'=>"$.fn.yiiGridView.update('base_admin_grid',{ data:{pageSize: $(this).val() }})",
			)),
		),
	),
)); ?>
