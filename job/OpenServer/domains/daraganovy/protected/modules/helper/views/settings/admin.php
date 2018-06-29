<?php
if(Yii::app()->user->checkAccess("developer")) {
	$template = '{update}{delete}';
	echo Helper::developerLink(Yii::app()->createUrl(Yii::app()->createUrl(Yii::app()->controller->module->id.'/'.Yii::app()->controller->id.'/create')), Yii::t('admin', 'Create new setting'));
}
else
	$template = '{update}';
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
			'name'=>'value',
			'value'=>'$data->element=="editor"?"<a href = \"".Yii::app()->createUrl("helper/settings/update", array("id"=>$data->id))."\">".Yii::t("admin", "Press to view value")."</a>":$data->value',
			'type'=>'raw',
		),
		array(
			'name'=>'module_id',
			'filter'=>Yii::app()->controller->module->settingsModules,
			'value'=>'Yii::app()->controller->module->settingsModules[$data->module_id]',
		),
		array(
			'name'=>'base_key',
			'value'=>'$data->base_key',
			'visible'=>Yii::app()->user->checkAccess("developer"),
		),
		array(
			'class'=>'bootstrap.widgets.BsButtonColumn',
			'template'=>$template,
			'header'=>CHtml::dropDownList('pageSize',$pageSize, Yii::app()->getModule('helper')->gridPager, array(
				'onchange'=>"$.fn.yiiGridView.update('base_admin_grid',{ data:{pageSize: $(this).val() }})",
			)),
		),
	),
)); ?>
