<div class="form b-product_form">
<?php 
$session=new CHttpSession;
$session->open();
$imgDir = '';
if($model->isNewRecord){
	$newDir = $this->checkDir($session);
	$session['uploadDir'] = ROOT_PATH.DIRECTORY_SEPARATOR.'upload'.DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR.$newDir.DIRECTORY_SEPARATOR;
} else {
	$imgDir = $session['uploadDir'] =  ROOT_PATH.DIRECTORY_SEPARATOR.'upload'.DIRECTORY_SEPARATOR.'partner'.DIRECTORY_SEPARATOR.$model->id.DIRECTORY_SEPARATOR;
}
$session->close();

?>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'product-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>500)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'position'); ?>
		<?php 
		if(!isset($model->position)) {
			$model->position = 1000;
		}
		echo $form->textField($model,'position'); ?>
		<?php echo $form->error($model,'position'); ?>
	</div>

	<div class="row radio_button">
		<?php echo $form->labelEx($model,'is_view'); ?>
		<div class = "radio_button">
		<?php 
			if(!isset($model->is_view)) {
				$model->is_view = 1;
			}
			echo $form->radioButtonList($model,'is_view',array('0'=>'Скрыт', '1'=>'Отображается'), array('separator'=>'<br/>'));
		?>
		<?php echo $form->error($model,'is_view'); ?>
		</div>
	</div>

        <div class="row">
                <?php echo $form->labelEx($model,'link'); ?>
                <?php echo $form->textField($model,'link',array('size'=>68,'maxlength'=>255)); ?>
                <?php echo $form->error($model,'link'); ?>
        </div>
       
	<div class = "g-clear_fix"></div>
	
	
	<div class = "g-clear_fix"></div>
	<div class="row">
		
		
            <?php echo $form->fileField($model, 'image');?>
            <?php 
			$path = Yii::getPathOfAlias('webroot').DS."upload".DS."partner".DS.$model->id.".jpg";
			if(file_exists($path)){
				echo '<br/><img src = "/upload/partner/'.$model->id.'.jpg" alt = "'.$model->name.'" />';
			}
		?>
            
	</div>
	<div class = "g-clear_fix"></div>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
	</div>
	
	
	
<?php $this->endWidget(); ?>

</div><!-- form -->