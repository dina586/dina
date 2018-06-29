<div class="content-header content-header-media">
	<div class="header-section">
		<h1 class = "pull-left"><?= UserHelper::getName($model); ?></h1>
		
		<?php if(UserHelper::checkAccess($model->id, true)): ?>
			<div class ="pull-right">
				<a href = "<?=UserHelper::link('user/view/background');?>" class="btn btn-sm btn-default">
					<i class="fa fa-upload"></i>
					<?=Yii::t('admin', 'Upload new background')?>
				</a>
			</div>
		<?php endif; ?>
	</div>
	<?=UserHelper::getBackground($model->profile, 'original', ['class'=>'animation-pulseSlow'])?>
</div>

<?php
if (Yii::app()->user->hasFlash('profile')): ?>
	<div class="alert alert-success">
		<p><i class="fa fa-check"></i> <?=Yii::app()->user->getFlash('profile')?></p>
	</div>
<?php endif; ?>

<div class="alert alert-danger alert-dismissable l-hidden" id = "d-profile_error">
	<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
    <h4><i class="fa fa-times-circle"></i> Error</h4>
	<p></p>
</div>

<div class="row">
	<!-- User avatar -->
	<div class="col-md-6 col-lg-3 b-profile_avatar">
		<div class="block">
			<div class ="b-profile_view_avatar" id = "j-avatar_controls">
				
				<div class="block-section text-center" id = "j-avatar_img">
					<?php 
						$this->widget('application.modules.user.widgets.AvatarWidget', 
							['model'=>$model->profile, 'type'=>'medium', 'renderType'=>'popup']
						);
					?>
				</div>
				
				<?php if(UserHelper::checkAccess($model->id, true)): ?>
					
					<?php if($model->profile->avatar_img != ''){ ?>
						<div class ="b-profile_delete_avatar" id = "a-avatar_delete">
							<a data-toggle = "tooltip" data-original-title = "<?=Yii::t('admin', 'Delete avatar')?>" data-href = "<?=Yii::app()->createUrl('user/assist/deleteAvatar', ['id'=>$model->id])?>" href = "#">
								<i class="hi hi-remove-circle"></i>
							</a>
						</div>
					<?php } ?>

					<div class ="b-upload_avatar_link" id = "j-avatar_links">
						<a href = "<?=UserHelper::link('user/view/avatar')?>">
							<i class="fa fa-cloud-upload"></i> 
							<?=Yii::t('admin', 'Upload new avatar')?>
						</a>
					</div>
				
				<?php endif; ?>
				
			</div>
		</div>
	</div><!-- End .b-profile_avatar -->
	
	<div class="col-md-6 col-lg-8">
		<div class="block">
			<div class="block-title">
				<h2><i class="fa fa-file-o"></i> <strong>Profile</strong> Info</h2>
			</div>
			
			<?php
			$this->widget('zii.widgets.CDetailView', array(
				'data' => $model,
				'htmlOptions' => array('class' => 'table table-borderless table-striped table-vcenter b-profile_table'),
				'attributes' => array(
					array(
						'name' => 'email',
						'type' => 'raw',
						'value' => BsHtml::mailto($model->email),
						'visible' => Yii::app()->user->checkAccess('admin')
					),
					array(
						'name' => 'login',
						'value' => $model->login == '' ? '' : $model->login,
					),
					array(
						'name' => 'create_at',
						'value' => $model->create_at,
						'visible' => Yii::app()->user->checkAccess('admin')
					),
					array(
						'name' => 'lastvisit_at',
						'value' => $model->lastvisit_at
					),
				)
			));
			?>
			
			
			<div class="block-section text-center">
				
				<?php if(UserHelper::checkAccess($model->id, true)): ?>
					
					<a href ="<?=UserHelper::link('user/view/edit');?>" class="btn btn-primary">
						<i class="fa fa-pencil"></i>
						<?= Yii::t('main', 'Edit'); ?>
					</a>
				
					<a href ="<?=UserHelper::link('user/view/changePassword');?>" class="btn btn-primary">
						<i class="fa fa-pencil"></i>
						<?= Yii::t('admin', 'Change Password'); ?>
					</a>
				
				<?php endif;?>
				
			</div>
			
			
		</div>

	</div>
</div>
