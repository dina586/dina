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
	$attributes = array(
		'username',
		'email',
	);
	
	$profileFields=ProfileField::model()->forAll()->sort()->findAll();
	if ($profileFields) {
		foreach($profileFields as $field) {
			array_push($attributes,array(
			'label' => UserModule::t($field->title),
			'name' => $field->varname,
			'value' => (($field->widgetView($model->profile))?$field->widgetView($model->profile):(($field->range)?Profile::range($field->range,$model->profile->getAttribute($field->varname)):$model->profile->getAttribute($field->varname))),
			));
		}
	}
	array_push($attributes,
		'create_at',
		array(
			'name' => 'lastvisit_at',
			'value' => (($model->lastvisit_at!='0000-00-00 00:00:00')?$model->lastvisit_at:UserModule::t('Not visited')),
		)
	);
	$this->widget('zii.widgets.CDetailView', array(
		'data'=>$model,
		'attributes'=>$attributes,
	));
?>
	
	<div class="b-user_edit_link"><a href="<?=Yii::app()->createUrl('user/profile/edit');?>"><?=Yii::t('admin', 'Edit Profile')?></a> <span>|</span> <a href="<?=Yii::app()->createUrl('user/profile/changepassword');?>"><?=Yii::t('admin', 'Change Password')?></a></div>
	
	<?=Helper::linkButton( Yii::t('main', 'Logout'), Yii::app()->createUrl('user/logout'), 
		array(
			'icon'=>BsHtml::GLYPHICON_LOG_IN,
			'color' => BsHtml::BUTTON_COLOR_PRIMARY,
			'size' => BsHtml::BUTTON_SIZE_SMALL,
		));?>
</div>