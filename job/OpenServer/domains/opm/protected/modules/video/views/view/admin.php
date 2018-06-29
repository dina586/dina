
<?php
$pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);
$this->widget('bootstrap.widgets.BsGridView', array(
	'id'=>'base_admin_grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'name',
		'position',
		'price',
		array(
			'name'=> 'is_view',
			'filter'=> Yii::app()->getModule('helper')->isView,
			'value'=>'Yii::app()->getModule("helper")->isView[$data->is_view]',
		),
		array(
			'class'=>'bootstrap.widgets.BsButtonColumn',
			'header'=>CHtml::dropDownList('pageSize',$pageSize, Yii::app()->getModule('helper')->gridPager, array(
				'onchange'=>"$.fn.yiiGridView.update('base_admin_grid',{ data:{pageSize: $(this).val() }})",
			)),
		),
	),
)); ?>
