<div class ="block full l-base_grid">
<?php

if(Yii::app()->user->checkAccess("developer"))
	$template = '{update}{delete}';
else
	$template = '{update}';

$this->widget('bootstrap.widgets.AdminGridView', [
	'id'=>'base_admin_grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>[
		[
			'name'=>'name',
			'value'=>'Yii::t("admin", $data->name)',
		],
		[
			'name'=>'value',
			'value'=>'$data->view_in_grid==0?"<a href = \"".Yii::app()->createUrl("settings/settings/update", array("id"=>$data->id))."\">".Yii::t("admin", "Press to view value")."</a>":$data->value',
			'type'=>'raw',
		],
		[
			'name'=>'module_id',
			'filter'=>Yii::app()->controller->module->settingsModules,
			'value'=>'Yii::app()->controller->module->settingsModules[$data->module_id]',
		],
		[
			'name'=>'base_key',
			'value'=>'$data->base_key',
			'visible'=>Yii::app()->user->checkAccess("admin"),
		],
		[
			'class'=>'bootstrap.widgets.AdminButtonColumn',
			'template'=>$template,
		],
	],
]);
?>
</div>