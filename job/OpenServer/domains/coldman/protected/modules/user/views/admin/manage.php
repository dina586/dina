<?php
if (Yii::app()->user->hasFlash('profile')): ?>
	<div class="alert alert-success">
		<p><i class="fa fa-check"></i> <?=Yii::app()->user->getFlash('profile')?></p>
	</div>
<?php endif; ?>

<div class ="block full l-base_grid">
<?php
$this->widget('bootstrap.widgets.AdminGridView', [
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>[
		'id',
		[
			'name' => 's_name',
			'type' => 'raw',
			'value' => 'BsHtml::link($data->profile->firstname." ".$data->profile->lastname, array("admin/view","id"=>$data->id), array("target"=>"_blank"))',
		],
		[
			'name'=>'email',
			'type'=>'raw',
			'value'=>'BsHtml::mailto($data->email)',
		],
		[
			'type' => 'raw',
			'filter' =>BsHtml::activeDropDownList($model, 'user_role', Roles::model()->getRoles(), array('empty'=>'')),
			'value' => '$data->r_role->role_name',
			'name' => 'user_role',
		],
		[
			'name'=>'status',
			'filter'=>Yii::app()->controller->module->status,
			'value'=>'Yii::app()->controller->module->status[$data->status]',
		],
		[
			'class'=>'bootstrap.widgets.AdminButtonColumn',
			'buttons'=>[
				'view'=>[
					'url'=>'Yii::app()->createUrl("user/view/profile", ["id"=>$data->id])',
				]
			]
		],
	],
]);
?>
</div>