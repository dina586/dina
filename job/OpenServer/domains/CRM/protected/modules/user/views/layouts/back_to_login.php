<?php $this->beginContent('//layouts/templates/login'); ?>

	<?php echo $content; ?>

	<div class="b-registration_footer">
		<div class="col-xs-12 text-center">
			<small><?= Yii::t('admin', 'Do you have an account?') ?></small> 
			<a id="link-register" href="<?= Yii::app()->createUrl('user/auth/login'); ?>">
				<small>Login</small>
			</a>
		</div>
	</div>
	<div class = "clearfix"></div>

<?php $this->endContent(); ?>