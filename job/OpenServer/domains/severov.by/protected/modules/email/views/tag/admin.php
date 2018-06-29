<?php
echo Helper::developerLink(Yii::app()->createUrl(Yii::app()->createUrl(Yii::app()->controller->module->id.'/'.Yii::app()->controller->id.'/create')), Yii::t('admin', 'Create Email tag'));

$pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);
$this->widget('bootstrap.widgets.BsGridView', array(
	'id'=>'base_admin_grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		array(
			'name'=>'name',
			'value'=>'Yii::t("admin", $data->name)',
		),
		array(
			'name'=>'tag',
			'value'=>'"{".$data->tag."}"',
		),
		array(
			'name'=>'tag_type',
			'filter'=>Yii::app()->controller->module->tagType,
			'value'=>'Yii::app()->controller->module->tagType[$data->tag_type]',
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
