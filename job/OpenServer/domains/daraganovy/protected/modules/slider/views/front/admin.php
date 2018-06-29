
<?php

$pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);
$this->widget('bootstrap.widgets.AdminGridView', array(
	'id'=>'base_admin_grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
			'name' => 'image',
			'type' => 'raw',
			'filter' => '',
			'value' => 'Fields::gridImage("/upload/".Yii::app()->controller->module->frontFolder."/".$data->id.".jpg")',
			'htmlOptions'=>array('class'=>'l-align_center l-grid_cover_column'),
			'header'=>Yii::t('main', 'Image'),
		),
		'id',
		'name',
		'position',
				
		array(
			'class' => 'bootstrap.widgets.AdminButtonColumn',
                                'template' => '{update}{delete}',
			
			),
		/*array(
			'class'=>'bootstrap.widgets.BsButtonColumn',
			'template'=>'{update}{delete}',
			'buttons'=>array (
				'view'=>array(
					'url'=>'Yii::app()->createUrl("'.Yii::app()->controller->module->id.'/'.Yii::app()->controller->id.'/view",array("url" => $data->url))',
				),
			),
			/*'header'=>CHtml::dropDownList('pageSize',$pageSize, Yii::app()->getModule('helper')->gridPager, array(
				'onchange'=>"$.fn.yiiGridView.update('base_admin_grid',{ data:{pageSize: $(this).val() }})",
			)),*/
		/*),*/
	),
)); ?>
