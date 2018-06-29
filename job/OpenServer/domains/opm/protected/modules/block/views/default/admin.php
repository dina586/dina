<div class = "l-form">
	<?=Helper::linkButton('Add new Block', Yii::app()->createUrl('/'.Yii::app()->controller->module->id.'/'.Yii::app()->controller->id.'/create'));?>
</div>

<?php 
$pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);
$this->widget('bootstrap.widgets.BsGridView', array(
	'id'=>'base_admin_grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'name',
		'title',
		'position',
		array(
			'name'=> 'page_position',
			'filter'=> Yii::app()->getModule('block')->namespace,
			'value'=>'Yii::app()->getModule("block")->namespace[$data->page_position]',
		),
		array(
			'name'=> 'is_view',
			'filter'=> Yii::app()->getModule('helper')->isView,
			'value'=>'Yii::app()->getModule("helper")->isView[$data->is_view]',
		),
		array(
			'name'=> 'view_title',
			'filter'=> Yii::app()->getModule('helper')->isView,
			'value'=>'Yii::app()->getModule("helper")->isView[$data->view_title]',
		),
		array(
			'class'=>'bootstrap.widgets.BsButtonColumn',
			'template'=>'{update}{delete}',
			'header'=>CHtml::dropDownList('pageSize',$pageSize, Yii::app()->getModule('helper')->gridPager, array(
				'onchange'=>"$.fn.yiiGridView.update('base_admin_grid',{ data:{pageSize: $(this).val() }})",
			)),
		),
	),
)); ?>
