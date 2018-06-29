<div class ="block full l-base_grid">
<div class = "l-form">
	<?=Helper::linkButton('Create new', Yii::app()->createUrl('/'.Yii::app()->controller->module->id.'/'.Yii::app()->controller->id.'/create'));?>
</div>
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
			'value' => 'Fields::gridImage("/upload/".Yii::app()->controller->module->folder."/".$data->id.".jpg", Yii::app()->createUrl("'.Yii::app()->controller->module->id.'/'.Yii::app()->controller->id.'/view",array("url" => $data->url)))',
			'htmlOptions'=>array('class'=>'l-align_center l-grid_cover_column'),
			'header'=>Yii::t('main', 'Image'),
		),
		'id',
		'name',
		
		array(
			'class' => 'bootstrap.widgets.AdminButtonColumn',
                                'template' => '{update}{delete}',
			
			),
	),
)); ?>
