<?php 
$this->seo(Yii::t('admin','Change Password'));
?>
<div class="l-base_wraper">
	<div class = "l-page_title_wrap">
		<h1 class = "l-page_title"><?=$this->pageTitle;?></h1>
	</div>
	
	<div class="l-form">
		<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
				'id'=>'b-'.Yii::app()->controller->module->id.'-form',
				'enableAjaxValidation'=>false,
			)); ?>
	
		<p class="l-note"><?php echo UserModule::t('Fields with <span class="required">*</span> are required.'); ?></p>
		
		<?php echo $form->errorSummary($model); ?>
		
		<div class="l-row">
			<?=$form->textFieldControlGroup($model, 'password');?>
			<p class="l-hint">
				<?php echo UserModule::t("Minimal password length 4 symbols."); ?>
			</p>
		</div>
		
		<div class="l-row">
			<?=$form->textFieldControlGroup($model, 'verifyPassword');?>
		</div>
		
		<?=Fields::submitBtn(Yii::t('admin',"Save"));?>
	
	<?php echo CHtml::endForm(); ?>
	</div><!-- l-form -->
</div>