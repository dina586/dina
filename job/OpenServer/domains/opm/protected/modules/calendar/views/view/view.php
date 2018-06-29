<div class="l-base_wraper">
	
	<div class = "l-page_title_wrap">
		<h1 class = "l-page_title"><?=$model->name;?></h1>
	</div>
	
	<div class = "g-clear_fix"></div>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'content',
		'start_date',
		'ent_date',
		'user_id',
		'worker_id',
		'status',
	),
)); ?>
</div>

<?=Helper::editLink(Yii::app()->createUrl(Yii::app()->controller->module->id.'/'.Yii::app()->controller->id.'/update', array('id'=>$model->id)));?>