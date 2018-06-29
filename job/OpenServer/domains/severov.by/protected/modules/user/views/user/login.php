<div class="l-base_wraper">
	
	<div class = "l-page_title_wrap">
		<h1 class = "l-page_title"><?=$this->pageTitle;?></h1>
	</div>
	
	<div class="l-form">
		<?php $form = $this->beginWidget('bootstrap.widgets.BsActiveForm',
			array(
				'id'=>'b-login-form',
				'enableAjaxValidation'=>false,
				'clientOptions'=>array(
					'validateOnSubmit'=>true,
				),
			));
		 ?>
		 <?php echo $form->errorSummary($model); ?>
		
		<div class="l-row">
			<?php echo $form->textFieldControlGroup($model,'username') ?>
		</div>
		
		<div class="l-row">
			<?php echo $form->passwordFieldControlGroup($model,'password') ?>
		</div>
		
		<div class="l-row">
			<a href = "<?=Yii::app()->createUrl('user/registration');?>"><?=Yii::t('main', 'Register')?></a>
			<span>|</span>
			<a href = "<?=Yii::app()->createUrl('user/recovery');?>"><?=Yii::t('main', 'Forgot a password?')?></a>
		</div>
		
		<?=Fields::submitBtn( Yii::t('main', 'Login'), BsHtml::GLYPHICON_LOG_IN);?>
		
		<div class = "g-clear_fix"></div>
		
	<?php $this->endWidget(); ?>
	</div><!-- form -->
</div>