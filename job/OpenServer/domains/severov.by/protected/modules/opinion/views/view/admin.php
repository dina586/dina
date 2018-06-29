
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
			'value' => 'Fields::gridImage("/upload/".Yii::app()->controller->module->folder."/".$data->id.".jpg")',
			'htmlOptions'=>array('class'=>'l-align_center l-grid_cover_column'),
			'header'=>Yii::t('main', 'Image'),
		),
		'id',
		'name',
		array(
			'name'=>'create_date',
			'value'=> '$data->create_date',		
		),
		array(
			'name'=> 'is_view',
			'filter'=> Yii::app()->getModule('helper')->isView,
			'value'=>'Yii::app()->getModule("helper")->isView[$data->is_view]',
		),
		array(
			'name'=> 'is_new',
			'filter'=> Yii::app()->getModule('opinion')->isNew,
			'value'=>'Yii::app()->getModule("opinion")->isNew[$data->is_new]',
		),
		array(
			'name'=> 'view_on_main',
			'filter'=> Yii::app()->getModule('opinion')->viewOnMain,
			'value'=>'Yii::app()->getModule("opinion")->viewOnMain[$data->view_on_main]',
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
