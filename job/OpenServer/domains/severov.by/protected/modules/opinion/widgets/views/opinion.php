<?php if(Yii::app()->user->hasFlash('save_opinion')): ?>
	
	<div class="l-system_message">
		<?php echo Yii::app()->user->getFlash('save_opinion'); ?>
	</div>
	
<?php else: ?>
		
	<div class="l-form">
	
	<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
		'id'=>'b-'.Yii::app()->controller->module->id.'-form',
		'enableAjaxValidation'=>false,
		'htmlOptions'=>array('enctype'=>'multipart/form-data'),
	)); ?>
		
		<?php echo $form->errorSummary($model); ?>
		
		<div class="l-row">
			<?=$form->textFieldControlGroup($model, 'name');?>
		</div>
		
		<div class="l-row">
			<?=$form->textAreaControlGroup($model, 'content');?>
		</div>
		
		<div class="l-row l-form_image">
			<?php Fields::fileField($model, $form, Yii::app()->controller->module->folder);?>
		</div>
		
		<?php Yii::app()->controller->renderPartial('helper_view.parts._captcha', array('model'=>$model, 'form'=>$form, 'field'=>'verifyCode'));?>
		
		
		<div class = "g-clear_fix"></div>
		
		<?=Fields::submitBtn('Добавить отзыв');?>
		
	<?php $this->endWidget(); ?>
	
	</div><!-- l-form -->

<?php endif;?>