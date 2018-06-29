<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'about-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('enctype'=>'multipart/form-data')
)); ?>

	<p class="note">Поля, отмеченные <span class="required">*</span> обязательны</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'brief_descr'); ?>
		<?php echo $form->textArea($model,'brief_descr',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'brief_descr'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php 
		$this->widget('ext.editor.CKeditor', array( 
			'model'=>$model,
			'attribute'=>'description',
		));
		?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date'); ?>
		<?php 
		if(!isset($model->date)) {
			$model->date = date("Y-m-d");
		}
		$this->widget('zii.widgets.jui.CJuiDatePicker', array(
		    'name'=>'About[date]',
			'value'=> $model->date,
			'language'=> Yii::app()->language,
		    'options'=>array(
		        'showAnim'=>'fold',
				'dateFormat'=>'yy-mm-dd',
				'constrainInput'=> 'true',
		    ),
		    'htmlOptions'=>array(
		    ),
		));
	?>
		<?php echo $form->error($model,'date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'position'); ?>
	
		<?php if(!isset($model->position)) {
			$model->position = 100;
		}
		?>
		<?php echo $form->textField($model,'position', array('value'=>$model->position)); ?>
		<?php echo $form->error($model,'position'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'image'); 	?>
		<?php echo CHtml::activeFileField($model, 'image'); 
		$path = ROOT_PATH.DIRECTORY_SEPARATOR."upload".DIRECTORY_SEPARATOR."about".DIRECTORY_SEPARATOR."thumbnails".DIRECTORY_SEPARATOR.$model->id.".jpg";
		if(file_exists($path)){
			echo '<br/><img src = "../../../upload/about/thumbnails/'.$model->id.'.jpg" />';
		}
		?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'seo_title'); ?>
		<?php echo $form->textArea($model,'seo_title',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'seo_title'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'seo_keywords'); ?>
		<?php echo $form->textArea($model,'seo_keywords',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'seo_keywords'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'seo_description'); ?>
		<?php echo $form->textArea($model,'seo_description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'seo_description'); ?>
	</div>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->