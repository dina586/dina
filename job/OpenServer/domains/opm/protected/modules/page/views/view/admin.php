<?php 
$template = '{view}{update}';
if(Yii::app()->user->role == 'developer')
	$template .= '{delete}';

$pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);
$this->widget('bootstrap.widgets.BsGridView', array(
	'id'=>'base_admin_grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'name',
		'url',
		'seo_title',
		'seo_description',
		'seo_keywords',
		array(
			'class'=>'bootstrap.widgets.BsButtonColumn',
			'template'=>$template,
			'buttons'=>array (
				'view'=>array(
					'url'=>'Yii::app()->createUrl("'.Yii::app()->controller->module->id.'/view/view",array("url" => $data->url))',
				),
			),
			'header'=>CHtml::dropDownList('pageSize',$pageSize, Yii::app()->getModule('helper')->gridPager, array(
				'onchange'=>"$.fn.yiiGridView.update('base_admin_grid',{ data:{pageSize: $(this).val() }})",
			)),
		),
	),
)); ?>
