<?php

Yii::app()->clientScript->registerScript('search', "
$('#a-user_form').submit(function(){
	$('#user-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");

?>

<div class ="g-clear_fix"></div>

<div class = "block full">
	<div class = "row">
		<div class ="panel panel-default">
			<div class ="panel-heading">
				<h4 class ="panel-title">Filters</h4>
			</div>
			<div class = "panel-body">
				<?php
				$this->renderPartial('_list_form', array(
					'model' => $model,
				));
				?>
			</div>
		</div>
	</div>
</div>

<div class ="g-clear_fix"></div>

<?php
$pageSize = Yii::app()->user->getState('pageSize', Yii::app()->params['defaultPageSize']);
$this->widget('bootstrap.widgets.BsGridView', array(
	'id' => 'user-grid',
	'dataProvider' => $model->listSearch(),
	'htmlOptions' => array('class' => 'grid-view j-user_grid'),
	//'filter'=>$model,
	'columns' => array(
		array(
			'name' => 's_name',
			'type' => 'raw',
			'header' => 'Name',
			'value' => 'BsHtml::link($data->profile->firstname." ".$data->profile->lastname, array("admin/view","id"=>$data->id), array("target"=>"_blank"))',
		),
		array(
			'name' => 's_phone',
			'type' => 'raw',
			'value' => '$data->profile->mobile',
			'header' => 'Phone',
		),
		array(
			'name' => 'email',
			'type' => 'raw',
			'value' => 'BsHtml::mailto($data->email)',
		),
		array(
			'name' => 's_city',
			'filter' => System::getCities('Profile'),
			'value' => '$data->profile->city_id==0?0:$data->profile->city->city_name_en',
		),
		/* array(
		  'name'=>'s_city',
		  'filter'=>System::getUserServices(),
		  'value'=>'$data->profile->city_id==0?0:$data->profile->city->city_name_en',
		  ), */
		array(
			'header' => Yii::t('admin', 'User role'),
			'type' => 'raw',
			'filter' => $model->adminSearchRoles(),
			'value' => '$data->adminSearchRoles($data->roles->role)',
			'name' => 'user_role',
		),
		array(
			'name' => 'create_at',
			'value' => '$data->create_at',
			'filter' => BsHtml::activeTextField($model, 'create_at', array("class" => "j-datetime", 'value' => System::viewDate($model->create_at, 'datetime'), 'placeholder' => '')),
		),
		array(
			'class' => 'bootstrap.widgets.BsButtonColumn',
			'template' => '{view}{update}{delete}',
			'header' => CHtml::dropDownList('pageSize', $pageSize, Yii::app()->getModule('helper')->gridPager, array(
				'onchange' => "$.fn.yiiGridView.update('base_admin_grid',{ data:{pageSize: $(this).val() }})",
			)),
			'buttons' => array(
				'service' => array(
					'label' => 'service', //put the span at label with icon class
					'url' => 'Yii::app()->createUrl("service/user/manage", array("id"=>$data->id))',
					'icon' => BsHtml::GLYPHICON_DASHBOARD,
					'options' => array('title' => 'View User Services'), // put here the title to show when mouse over
				),
			)
		),
	),
));
?>

<script type = "text/javascript">
    /*Изменение роли пользователя CGridView*/
    $(document).on('change', '.j-user_grid tbody .j-user_role', function () {
        var index = $('.j-user_grid tbody .j-user_role').index(this);
        var id = $('.j-user_grid tbody tr:eq(' + index + ') td:first').text();
        var role = $(this).val();
        $.ajax({
            url: '/user/admin/changerole',
            type: 'POST',
            data: ({id: id, role: role}),
        })
    })
</script>