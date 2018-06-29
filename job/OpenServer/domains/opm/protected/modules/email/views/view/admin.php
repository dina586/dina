<?php
if(Yii::app()->user->checkAccess("developer")) {
	$template = '{update}{delete}';
	echo Helper::developerLink(Yii::app()->createUrl(Yii::app()->createUrl(Yii::app()->controller->module->id.'/'.Yii::app()->controller->id.'/create')), Yii::t('admin', 'Create Email message'));
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
			'name'=>'subject',
			'value'=>'Yii::t("admin", $data->subject)',
		),
		array(
			'name'=>'email_type',
			'filter'=>Yii::app()->controller->module->emailFor,
			'value'=>'Yii::app()->controller->module->emailFor[$data->email_type]',
		),
		array(
			'name'=>'email_key',
			'value'=>'$data->email_key',
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
