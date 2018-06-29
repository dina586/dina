<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-body">
				<p>Use search to find contacts. You can search by: name, email,
					phone. Or use the advanced search.</p>
				<form class="form-horizontal">
					<div class="form-group">
						<div class="col-md-8">
							<div class="input-group">
								<div class="input-group-addon">
									<span class="fa fa-search"></span>
								</div>
								<?php 
								$form = $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
									'layout' => BsHtml::FORM_LAYOUT_HORIZONTAL,
									'id'=>'user-form',
									'enableAjaxValidation'=>false,
								));
								?>
								<?=$form->textField($model, 's_user', array('class'=>"form-control"));?>
								<div class="input-group-btn">
									<button class="btn btn-primary">Search</button>
								</div>
								<?php $this->endWidget(); ?>
							</div>
						</div>
						<div class="col-md-4">
							<a href = "<?=Yii::app()->createUrl('user/admin/create')?>" class="btn btn-success btn-block">
								<span class="fa fa-plus"></span> Add new client
							</a>
						</div>
					</div>
				</form>
			</div>
		</div>

	</div>
</div>

<div class="row b-user_list">               
	<?php
	
	$this->widget('bootstrap.widgets.BsListView', array(
			'dataProvider' => $dataProvider,
			'itemView' => '_view' 
	));
?>
</div>
<?php /*
$pageSize=Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']);
$this->widget('bootstrap.widgets.BsGridView', array(
	'id'=>'user-grid',
	'dataProvider'=>$model->search(),
	'htmlOptions' => array('class' => 'grid-view j-user_grid'),
	'filter'=>$model,
	'columns'=>array(
		array(
			'name' => 's_name',
			'type'=>'raw',
			'header'=>'Name',
			'value' => 'BsHtml::link($data->profile->firstname." ".$data->profile->lastname, array("admin/view","id"=>$data->id), array("target"=>"_blank"))',
		),

		array(
			'name'=>'s_phone',
			'type'=>'raw',
			'value'=>'$data->profile->mobile',
			'header'=>'Phone',
		),

		array(
			'header'=>Yii::t('admin','User role'),
			'type' => 'raw',
			'filter'=> $model->adminSearchRoles(),
			'value'=>'$data->adminSearchRoles($data->roles->role)',
			'name'=>'user_role',
		),
		array(
			'name'=>'create_at',
			'value'=>'$data->create_at',
			'filter'=>BsHtml::activeTextField($model, 'create_at', array("class"=>"j-datetime", 'value'=>System::viewDate($model->create_at, 'datetime'), 'placeholder'=>'')),
				
		),
		array(
			'class'=>'bootstrap.widgets.BsButtonColumn',
			'template'=>'{view}{update}{delete}',
			'header'=>CHtml::dropDownList('pageSize',$pageSize, Yii::app()->getModule('helper')->gridPager,array(
				'onchange'=>"$.fn.yiiGridView.update('base_admin_grid',{ data:{pageSize: $(this).val() }})",
			)),
			'buttons'=>array(
				'service' => array(
					'label'=>'service',     //put the span at label with icon class
					'url'=>'Yii::app()->createUrl("service/user/manage", array("id"=>$data->id))',
					'icon'=>BsHtml::GLYPHICON_DASHBOARD,
					'options'=>array('title'=>'View User Services'), // put here the title to show when mouse over
				),
			)
		),
	),
)); 
*/
?>

<script type="text/javascript">
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