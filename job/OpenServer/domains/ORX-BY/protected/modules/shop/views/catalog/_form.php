<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'catalog-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'parent_id'); ?>
		<?php echo $form->dropDownList($model,'parent_id', Catalog::catalogList(), array('empty' => 'Выберите каталог')); ?>
		<?php echo $form->error($model,'parent_id'); ?>
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
		
	<div class="row">
		<?php echo $form->labelEx($model,'content'); ?>
		<?php 
		$this->widget('ext.editor.CKeditor', array( 
			'model'=>$model,
			'attribute'=>'content',
		));
		?>
		<?php echo $form->error($model,'content'); ?>
	</div>
	
	<div class="row radio_button">
		<?php echo $form->labelEx($model,'view_on_main'); ?>
		<div class = "radio_button">
		<?php 
			if(!isset($model->view_on_main)) {
				$model->view_on_main = 0;
			}
			echo $form->radioButtonList($model,'view_on_main',array('0'=>'Не отображается', '1'=>'Выводится'), array('separator'=>'<br/>'));
		?>
		<?php echo $form->error($model,'view_on_main'); ?>
		</div>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'seo_title'); ?>
		<?php echo $form->textArea($model,'seo_title', array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'seo_title'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'seo_keywords'); ?>
		<?php echo $form->textArea($model,'seo_keywords', array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'seo_keywords'); ?>
	</div>
	<div class="row">
		<?php echo $form->labelEx($model,'seo_description'); ?>
		<?php echo $form->textArea($model,'seo_description', array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'seo_description'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'url'); ?>
		<?php echo $form->textField($model,'url',array('size'=>68,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'url'); ?>
	</div>
	
	<div class="row b-form_image">
		<?php echo $form->labelEx($model,'image'); 	?>
		<?php echo $form->fileField($model, 'image');?>
		<?php 
			$path = Yii::getPathOfAlias('webroot').DS."upload".DS.'catalog'.DS.$model->id.".jpg";
			if(file_exists($path)){
				echo '<br/><img src = "/upload/catalog/'.$model->id.'.jpg" alt = "'.$model->name.'" />';
			}
		?>
	</div>
	<div class = "g-clear_fix"></div>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->