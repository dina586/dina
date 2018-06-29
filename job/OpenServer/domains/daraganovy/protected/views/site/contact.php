<div class="g-content">
	<div class="l-base_wraper">
		
		<div class = "l-page_title_wrap">
			<h1 class = "l-page_title"><?=$content->name;?></h1>
		</div>

	</div>

	<p><?=$content->content;?></p>
	<?php if(Yii::app()->user->hasFlash('contact')): ?>

	<div class="flash-success">
		<?php echo Yii::app()->user->getFlash('contact'); ?>
	</div>

	<?php else: ?>


	<div class="l-form">

		<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
            'id'=>'contact-form',
            'enableClientValidation'=>false,
            'clientOptions'=>array(
            'validateOnSubmit'=>false,
				),
			)); 
        ?>

	<div class="l-row">
        <?php echo $form->textFieldControlGroup($model,'name'); ?>
    </div>

	<div class="l-row">
        <?php echo $form->emailFieldControlGroup($model,'email'); ?>
    </div>

	<div class="l-row">
        <?php echo $form->textFieldControlGroup($model,'subject'); ?>
    </div>

	<div class="l-row">
        <?php echo $form->textAreaControlGroup($model,'message'); ?>
    </div>
	
	<?php Yii::app()->controller->renderPartial('helper.parts._captcha', array('model'=>$model, 'form'=>$form, 'field'=>'verifyCode'));?>
                                    			
    <div class = "g-clear_fix"></div>

	<?=Fields::submitBtn( Yii::t('main','Send'), BsHtml::GLYPHICON_ENVELOPE);?>

	<?php $this->endWidget(); ?>

	</div><!-- form -->

	<?php endif; ?>
</div>