<div class="content-header content-header-media">
	<div class="header-section">
		<h1><?= UserHelper::getName($model); ?></h1>
	</div>
	<!-- For best results use an image with a resolution of 2560x248 pixels (You can also use a blurred image with ratio 10:1 - eg: 1000x100 pixels - it will adjust and look great!) -->
	<img src="<?= Yii::app()->theme->baseUrl ?>/img/placeholders/headers/profile_header.jpg" alt="header image" class="animation-pulseSlow">
</div>

<?php
if (Yii::app()->user->hasFlash('profile')): ?>
	<div class="alert alert-success">
		<p><i class="fa fa-check"></i> <?=Yii::app()->user->getFlash('profile')?></p>
	</div>
<?php endif; ?>


<div class="row">
	<!-- User avatar -->
	<div class="col-md-6 col-lg-3 b-profile_avatar">
		<div class="block">
			<div class ="b-profile_view_avatar" id = "j-avatar_controls">
				<div class ="b-profile_delete_avatar" id = "a-avatar_delete">
					<a data-toggle = "tooltip" data-original-title = "<?=Yii::t('admin', 'Delete avatar')?>" href = "<?=UserHelper::link('user/view/avatar')?>">
						<i class="hi hi-remove-circle"></i>
					</a>
				</div>
				
				<div class="block-section text-center" id = "j-avatar_img" data-toggle = "lightbox-gallery">
					<a class = "gallery-link" href = "<?=UserHelper::avatar($model->profile, '', true);?>">
						<?=UserHelper::avatar($model->profile, 'medium');?>
					</a>
				</div>
				
				<div class ="b-upload_avatar_link" id = "j-avatar_links">
					<a href = "<?=UserHelper::link('user/view/avatar')?>">
						<i class="fa fa-cloud-upload"></i> 
						<?=Yii::t('admin', 'Upload new avatar')?>
					</a>
					<a href ="<?=UserHelper::link('user/view/thumbnail')?>"><i class="gi gi-vector_path_square"></i> <?=Yii::t('admin', 'Crop Image')?></a>
				</div>
			</div>
		</div>
	</div><!-- End .b-profile_avatar -->
	
	<div class="col-md-6 col-lg-8">
		<!-- Customer Info Block -->
		<div class="block">

			<?php
			$this->widget('zii.widgets.CDetailView', array(
				'data' => $model,
				'htmlOptions' => array('class' => 'table table-borderless table-striped table-vcenter b-profile_table'),
				'attributes' => array(
					array(
						'name' => 'email',
						'type' => 'raw',
						'value' => BsHtml::mailto($model->email),
					),
					array(
						'name' => 'login',
						'value' => $model->login == '' ? '' : $model->login,
					),
					array(
						'name' => 'create_at',
						'value' => $model->create_at
					),
					array(
						'name' => 'lastvisit_at',
						'value' => $model->lastvisit_at
					),
				)
			));
			?>
			<div class="block-section text-center">
				<a href ="<?= Yii::app()->createUrl('/user/view/edit', array('id' => $model->id)) ?>" class="btn btn-primary">
					<i class="fa fa-pencil"></i>
					<?= Yii::t('main', 'Edit'); ?>
				</a>
				<a href ="<?= Yii::app()->createUrl('/user/view/changePassword') ?>" class="btn btn-primary">
					<i class="fa fa-pencil"></i>
					<?= Yii::t('admin', 'Change Password'); ?>
				</a>
			</div>
		</div>
		<!--END Customer Info Block -->

	</div>
</div>
