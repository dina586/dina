<div class = "g-clear_fix"></div>
<div class ="block full">
<a class="btn btn-success btn-block" href="<?=Yii::app()->createUrl('user/regType/create')?>">
	<span class="fa fa-plus"></span> Add new user type
</a>
</div>
<div class = "g-clear_fix"></div>

<?php
$pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);
$this->widget('bootstrap.widgets.BsGridView', array(
	'id'=>'base_admin_grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'name',
		'position',
		'email_template',
		array(
			'name'=>'group_id',
			'value'=>'$data->group->name',
			'filter'=>CHtml::listData(UserGroup::model()->findAll(array('order'=>'position, name')), 'id', 'name'),
		),
		array(
			'template'=>'{update}{delete}',
			'class'=>'bootstrap.widgets.BsButtonColumn',
				'header'=>CHtml::dropDownList('pageSize',$pageSize, Yii::app()->getModule('helper')->gridPager, array(
				'onchange'=>"$.fn.yiiGridView.update('base_admin_grid',{ data:{pageSize: $(this).val() }})",
			)),
		),
	),
)); ?>
