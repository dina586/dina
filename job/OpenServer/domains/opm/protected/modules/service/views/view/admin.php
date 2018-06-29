<?php 

$pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);
$this->widget('bootstrap.widgets.BsGridView', array(
	'id'=>'base_admin_grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'name',
		array(
			'name'=> 'contract',
			'filter'=> Yii::app()->getModule('service')->contract,
			'value'=>'Yii::app()->getModule("service")->contract[$data->contract]',
		),
		array(
			'name'=> 'is_view',
			'filter'=> Yii::app()->getModule('helper')->isView,
			'value'=>'Yii::app()->getModule("helper")->isView[$data->is_view]',
		),
		array(
			'name'=> 'view_on_site',
			'filter'=> Yii::app()->getModule('helper')->isView,
			'value'=>'Yii::app()->getModule("helper")->isView[$data->view_on_site]',
		),
		array(
			'class'=>'bootstrap.widgets.BsButtonColumn',
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
