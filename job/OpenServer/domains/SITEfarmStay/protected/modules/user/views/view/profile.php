<!-- User Profile Header -->
<!-- For an image header add the class 'content-header-media' and an image as in the following example -->
<div class="content-header content-header-media">
	<div class="header-section">
		<img src="<?= Yii::app()->theme->baseUrl ?>/img/placeholders/avatars/avatar2.jpg" alt="Avatar" class="pull-right img-circle">
		<h1><?= UserHelper::getName($model); ?></h1>
	</div>
	<!-- For best results use an image with a resolution of 2560x248 pixels (You can also use a blurred image with ratio 10:1 - eg: 1000x100 pixels - it will adjust and look great!) -->
	<img src="<?= Yii::app()->theme->baseUrl ?>/img/placeholders/headers/profile_header.jpg" alt="header image" class="animation-pulseSlow">
</div>

<?php if (Yii::app()->user->hasFlash('profile')): ?>
	<div class="alert alert-success">
		<p><i class="fa fa-check"></i> <?=Yii::app()->user->getFlash('profile')?></p>
	</div>
<?php endif; ?>

<!-- END User Profile Header -->
<div class="row">
	<div class="col-lg-4">
		<!-- Customer Info Block -->
		<div class="block">
			<!-- Customer Info Title -->
			<div class="block-title">
				<h2><i class="fa fa-file-o"></i> <strong>Profile</strong> Info</h2>
			</div>
			<!-- END Customer Info Title -->

			<!-- Customer Info -->
			<div class="block-section text-center">
				<img class="img-circle" alt="avatar" src="<?= Yii::app()->theme->baseUrl ?>/img/placeholders/avatars/avatar4@2x.jpg" />
				<h3>
					<strong><?= UserHelper::getName($model); ?></strong><br><small></small>
				</h3>
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
