
<div class = "l-form">
	<?=Helper::adminMoveSeo(Yii::app()->controller->module->id.'/'.Yii::app()->controller->id.'/seo');?>
	<?=Helper::linkButton('Add new Trade Show', Yii::app()->createUrl('/'.Yii::app()->controller->module->id.'/'.Yii::app()->controller->id.'/create'));?>
</div>


<?php
$pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);
$this->widget('bootstrap.widgets.BsGridView', array(
	'id'=>'base_admin_grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
			'name' => 'image',
			'type' => 'raw',
			'filter' => '',
			'value' => 'Fields::gridImage("/upload/".Yii::app()->controller->module->folder."/".$data->id.".jpg", Yii::app()->createUrl("'.Yii::app()->controller->module->id.'/'.Yii::app()->controller->id.'/view",array("url" => $data->url)))',
			'htmlOptions'=>array('class'=>'l-align_center l-grid_cover_column'),
			'header'=>Yii::t('main', 'Image'),
		),
		'id',
		'name',
		array(
			'name'=>'date',
			'value'=> '$data->date',		
		),
		array(
			'name'=> 'is_view',
			'filter'=> Yii::app()->getModule('helper')->isView,
			'value'=>'Yii::app()->getModule("helper")->isView[$data->is_view]',
		),
		array(
			'class'=>'bootstrap.widgets.BsButtonColumn',
			'buttons'=>array (
				'view'=>array(
					'url'=>'Yii::app()->createUrl("'.Yii::app()->controller->module->id.'/'.Yii::app()->controller->id.'/view",array("url" => $data->url))',
				),
			),
			'header'=>CHtml::dropDownList('pageSize',$pageSize, Yii::app()->getModule('helper')->gridPager, array(
				'onchange'=>"$.fn.yiiGridView.update('base_admin_grid',{ data:{pageSize: $(this).val() }})",
			)),
		),
	),
)); ?>
