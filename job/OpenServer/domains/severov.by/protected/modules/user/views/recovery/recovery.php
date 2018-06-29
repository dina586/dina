<?php $this->seo(Yii::t('admin', 'Password recovery')); ?>
<div class="l-base_wraper">
	<div class = "l-page_title_wrap">
		<h1 class = "l-page_title"><?=$this->pageTitle;?></h1>
	</div>
	
	<?php if(Yii::app()->user->hasFlash('recoveryMessage')): ?>
		<div class="l-system_message">
			<p><?php echo Yii::app()->user->getFlash('recoveryMessage'); ?></p>
		</div>
	<?php else: ?>
	
		<div class="l-form">

			<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
				'id'=>'b-'.Yii::app()->controller->module->id.'-form',
				'enableAjaxValidation'=>false,
			)); ?>
		
			<?php echo $form->errorSummary($model); ?>
			
			<div class="l-row">
				<?=$form->textFieldControlGroup($model, 'login_or_email');?>
				<p class="l-hint"><?=Yii::t('admin', "Please enter your login or email address."); ?></p>
			</div>
			
			<div class = "g-clear_fix"></div>
			
			<?=Fields::submitBtn(UserModule::t("Restore"), BsHtml::GLYPHICON_REFRESH);?>
		
			<?php $this->endWidget(); ?>
		</div>
	<?php endif; ?>
</div>