<?php $this->seo(Yii::t('admin', 'Password recovery')); ?>
<div class="l-base_wraper">
	<div class = "l-page_title_wrap">
		<h1 class = "login-title"><?=$this->pageTitle;?></h1>
	</div>
	
	<?php if(Yii::app()->user->hasFlash('recoveryMessage')): ?>
		<div class="l-system_message">
			<p><?php echo Yii::app()->user->getFlash('recoveryMessage'); ?></p>
		</div>
	<?php else: ?>
	

			<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
				'id'=>'b-'.Yii::app()->controller->module->id.'-form',
				'layout' => BsHtml::FORM_LAYOUT_HORIZONTAL,
				'enableAjaxValidation'=>false,
			)); ?>
		
			<?php echo $form->errorSummary($model); ?>
			
			<div class = "g-clear_fix"></div>
			
			<div class = "l-no_label">
				<?=$form->textFieldControlGroup($model, 'login_or_email');?>
			</div>
			
			<p class="l-hint"><?=Yii::t('admin', "Please enter your login or email address."); ?></p>
			
			<div class = "g-clear_fix"></div>
			
			<div class="form-group">
				
				<div class="col-md-6">
					<a href="<?=Yii::app()->createUrl('user/login');?>" class="btn btn-link btn-block">Back to login form</a>
				</div>
				
				<div class="col-md-6">
					<button class="btn btn-success btn-block">Restore</button>
				</div>
				
			</div>
		
		<?php $this->endWidget(); ?>
	<?php endif; ?>
</div>