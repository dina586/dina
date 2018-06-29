<?php 

$this->widget('bootstrap.widgets.BsGridView', array(
	'id'=>'user-grid',
	'dataProvider'=>$model->search(),
	'htmlOptions' => array('class' => 'grid-view j-user_grid'),
	'filter'=>$model,
	'columns'=>array(
		array(
			'name' => 'id',
			'type'=>'raw',
			'value' => 'CHtml::link(CHtml::encode($data->id),array("admin/update","id"=>$data->id))',
		),
		array(
			'name' => 'username',
			'type'=>'raw',
			'value' => 'CHtml::link(UHtml::markSearch($data,"username"),array("admin/view","id"=>$data->id))',
		),
		array(
			'name'=>'email',
			'type'=>'raw',
			'value'=>'CHtml::link(UHtml::markSearch($data,"email"), "mailto:".$data->email)',
		),

		array(
			'header'=>Yii::t('admin','User role'),
			'type' => 'raw',
			'filter'=> $model->adminSearchRoles(),
			'value'=>'$data->adminSearchRoles($data->roles->role)',
			'name'=>'user_role',
		),
		array(
			'name'=>'status',
			'value'=>'User::itemAlias("UserStatus",$data->status)',
			'filter' => User::itemAlias("UserStatus"),
		),
		array(
			'class'=>'bootstrap.widgets.BsButtonColumn',
		),
	),
)); ?>

<script type = "text/javascript">
/*Изменение роли пользователя CGridView*/
$('.j-user_grid tbody .j-user_role').live('change', function() {
	var index = $('.j-user_grid tbody .j-user_role').index(this);
	var id = $('.j-user_grid tbody tr:eq('+index+') td:first').text();
	var role = $(this).val();
	$.ajax({
		url: '/user/admin/changerole',
		type:'POST',
		data: ({id : id, role : role}),
	})
})
</script>