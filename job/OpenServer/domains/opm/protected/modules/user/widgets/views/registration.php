<?php 
Yii::app()->clientScript->registerPackage('mask');
JS::add('mobilemask', '$(".j-mobile_field").mask("(999) 999-9999");');
?>
<div class = "l-form j-order_form">
	<?php $form= $this->beginWidget('bootstrap.widgets.BsActiveForm', array(
		'id'=>'b-quick_form',
		'enableAjaxValidation'=>false,
	)); ?>
			
	<?php Yii::app()->controller->renderPartial('application.modules.user.widgets.views._registration_fields', ['model'=>$model, 'form'=>$form])?>
				
	<div class = "g-clear_fix"></div>
					
	<?=Fields::submitBtn( Yii::t('main','Proceed'), BsHtml::GLYPHICON_ENVELOPE);?>
				
	<?php $this->endWidget(); ?>
</div>
       
		
