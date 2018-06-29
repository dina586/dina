<?php
	$image = Helper::getCover($model->id, get_class($model), Yii::app()->createUrl('user/admin/view', array("id"=>$model->id)), 'admin', '<img alt = "" src = "/images/noavatar.jpg"/>');
?>
<div class="row">
	<div class="col-md-3">
		<div class="panel panel-default b-profile_view">
			<div class="panel-body profile">
				<div class="profile-image">
					<?=$image;?>
				</div>
				<div class="profile-data">
					<div class="profile-data-name"><?=$model->profile->firstname." ".$model->profile->lastname;?></div>
					<!-- <div class="profile-data-title">Singer-Songwriter</div> -->
				</div>
				<div class="profile-controls">
					<a href="#" class="profile-control-left twitter">
						<span class="fa fa-twitter"></span>
						</a> 
						<a href="#" class="profile-control-right facebook">
							<span class="fa fa-facebook"></span>
						</a>
				</div>
			</div>
			
			<div class="panel-body">
				<div class="row">
					<a
						href="<?=Yii::app()->createUrl('user/admin/update', array('id'=>$model->id));?>"
						class="btn btn-info btn-rounded btn-block"> <span
						class="fa fa-edit"></span> Edit
					</a>
				</div>
			</div>
			
			<div class = "g-clear_fix"></div>
			
			<div class="b-profile_info border-top">
				<ul>
					<li>
						<span class="glyphicon glyphicon-phone"></span>
						<?=$profile->mobile;?>
					</li>
					<li>
						<span class="glyphicon glyphicon-home"></span>
						<?=Helper::viewAddress($profile);?>
					</li>
					<li>
						<span class="glyphicon glyphicon-envelope"></span>
						<a href = "mailto:<?=$model->email;?>"><?=$model->email;?></a>
					</li>
				</ul>
			</div>
			
			<div class="panel-body list-group border-bottom">
				<a href="<?=Yii::app()->createUrl('/user/procedure/manage', array('id'=>$model->id))?>"	class="list-group-item"> 
					<span class="fa fa-bar-chart-o"></span>
					Procedures
				</a>
				<a href="<?=Yii::app()->createUrl('/invoice/invoice/manage', array('id'=>$model->id))?>" class="list-group-item"> 
					<span class="fa fa-money"></span>
					Invoices
				</a>
			</div>
			
			<?php 
				$photos = trim($this->widget('file_uploader.ImageRenderWidget', array('id'=>$model->id, 'modelName'=>get_class($model), 'type'=>'admin', 'cover'=>false), true));
				if($photos != ''):
			?>
				<div class="panel-body b-profile_photos">
					<h4 class="text-title">Photos</h4>
						<?=$photos;?>
				</div>
			<?php endif;?>
			
			<div class="panel-body">
				<h4 class="text-title">Additional information</h4>
				
				<?php
				if (isset ( Yii::app ()->getModule ( 'user' )->carriers [$profile->carriers] ))
					$carriers = Yii::app ()->getModule ( 'user' )->carriers [$profile->carriers];
				else
					$carriers = '';
				
				if (isset ( Yii::app ()->getModule ( 'user' )->hear [$profile->here_about] ))
					$hear = Yii::app ()->getModule ( 'user' )->hear [$profile->here_about];
				else
					$hear = '';
			
				$this->widget ( 'bootstrap.widgets.BsDetailView', array (
					'data' => $model,
					'attributes' => array (
						array (
							'name' => 'carriers',
							'value' => $carriers 
						),
						array (
							'name' => 'Hear About Us',
							'value' => $hear 
						),
						array (
							'name' => 'friend_name',
							'value' => $profile->friend_name 
						),
						array (
							'name' => 'occupation',
							'type' => 'raw',
							'value' => $profile->occupation 
						),
						'create_at',
						array (
							'name' => 'notes',
							'type' => 'raw',
							'value' => $profile->notes 
						) 
					)
				) );
				?>
			</div>
		</div>

	</div>

	<div class="col-md-9">
		<?php $this->widget('application.modules.user.widgets.ProfileProcedureWidget', array(
			'status'=>'to_visit',
			'userId'=>$model->id,
			'avatar'=>$image,		
		));?>                                
		<?php $this->widget('application.modules.user.widgets.ProfileProcedureWidget', array(
			'status'=>'complete',
			'userId'=>$model->id,
			'avatar'=>$image,		
		));?>                                
	</div>

</div>

