<div class="l-base_wraper">
	
	<div class = "l-page_title_wrap">
		<h1 class = "l-page_title"><?=$model->name;?></h1>
	</div>
	
	<div class = "g-clear_fix"></div>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'file',
		'file_type',
		'folder',
		'description',
		'position',
		'cover',
		'date',
		'model_id',
		'model_name',
	),
)); ?>
</div>

<?php $this->edit(Yii::app()->createUrl(Yii::app()->controller->module->id.'/'.Yii::app()->controller->id.'/update', array('id'=>$model->id)));?>