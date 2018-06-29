<div class="l-base_wraper">
	
	<div class = "l-page_title_wrap">
		<h1 class = "l-page_title"><?=$this->pageTitle;?></h1>
	</div>
	
	<div class = "g-clear_fix"></div>

<?php if(Yii::app()->user->hasFlash('profileMessage')): ?>
	<div class="l-system_message">
		<p><?php echo Yii::app()->user->getFlash('profileMessage'); ?></p>
	</div>
<?php endif; ?>

<?php 
	$this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'attributes'=>array(
			'email',
			array(
				'name'=>'Login',
				'value' => $model->username,
			),
			array(
				'value'=>$profile->lastname.' '.$profile->firstname,
				'name'=>'Name',
			),
			array(
				'name'=>'Address',
				'value'=>$profile->country->country_name_en.', '.$profile->city->city_name_en.', '.$profile->address,
			),
			array(
				'name'=>'Mobile',
				'value'=>$profile->mobile,
			),
			array(
				'name'=>'Zip',
				'value'=>$profile->zip,
			),
			array(
				'name'=>'apartments',
				'value'=>$profile->apartments,
			),
			'create_at',
			array(
				'name' => 'lastvisit_at',
				'value' => (($model->lastvisit_at!='0000-00-00 00:00:00')?$model->lastvisit_at:UserModule::t('Not visited')),
			)
		),
	));
?>
	
	<div class="b-user_edit_link"><a href="<?=Yii::app()->createUrl('user/profile/edit');?>"><?=Yii::t('admin', 'Edit Profile')?></a> <span>|</span> <a href="<?=Yii::app()->createUrl('user/profile/changepassword');?>"><?=Yii::t('admin', 'Change Password')?></a></div>
	
	<?=Helper::linkButton( Yii::t('main', 'Logout'), Yii::app()->createUrl('user/logout'), 
		array(
			'icon'=>BsHtml::GLYPHICON_LOG_IN,
			'color' => BsHtml::BUTTON_COLOR_SUCCESS,
			'size' => BsHtml::BUTTON_SIZE_SMALL,
		));?>
</div>