<div class="form b-product_form">
<?php 
$session=new CHttpSession;
$session->open();
$imgDir = '';
if($model->isNewRecord){
	$newDir = $this->checkDir($session);
	$session['uploadDir'] = ROOT_PATH.DIRECTORY_SEPARATOR.'upload'.DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR.$newDir.DIRECTORY_SEPARATOR;
} else {
	$imgDir = $session['uploadDir'] =  ROOT_PATH.DIRECTORY_SEPARATOR.'upload'.DIRECTORY_SEPARATOR.'product'.DIRECTORY_SEPARATOR.$model->id.DIRECTORY_SEPARATOR;
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
		<?php echo $form->labelEx($model,'content'); ?>
		<?php 
		$this->widget('ext.editor.CKeditor', array( 
			'model'=>$model,
			'attribute'=>'content',
		));
		?>
		<?php echo $form->error($model,'content'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'price'); ?>
		<?php echo $form->textField($model,'price'); ?>
		<?php echo $form->error($model,'price'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'share_price'); ?>
		<?php echo $form->textField($model,'share_price'); ?>
		<?php echo $form->error($model,'share_price'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date'); ?>
		<?php 
		if(!isset($model->date)) {
			$model->date = date("Y-m-d");
		}
		$this->widget('zii.widgets.jui.CJuiDatePicker', array(
		    'name'=>'Product[date]',
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
		<?php echo $form->labelEx($model,'in_stock'); ?>
		<div class = "radio_button">
		<?php 
			if(!isset($model->in_stock)) {
				$model->in_stock = 0;
			}
			echo $form->radioButtonList($model,'in_stock',array('0'=>'Не учавствует в акции', '1'=>'Товар на акции'), array('separator'=>'<br/>'));
		?>
		<?php echo $form->error($model,'in_stock'); ?>
		</div>
	</div>
	
	<div class="row radio_button">
		<?php echo $form->labelEx($model,'new'); ?>
		<div class = "radio_button">
		<?php 
			if(!isset($model->new)) {
				$model->new = 0;
			}
			echo $form->radioButtonList($model,'new',array('0'=>'Нет', '1'=>'Да'), array('separator'=>'<br/>'));
		?>
		<?php echo $form->error($model,'new'); ?>
		</div>
	</div>
	
	<div class="row radio_button">
		<?php echo $form->labelEx($model,'popular'); ?>
		<div class = "radio_button">
		<?php 
			if(!isset($model->popular)) {
				$model->popular = 0;
			}
			echo $form->radioButtonList($model,'popular',array('0'=>'Не отображается', '1'=>'Выводится в слайдер'), array('separator'=>'<br/>'));
		?>
		<?php echo $form->error($model,'popular'); ?>
		</div>
	</div>
	
	<div class="row radio_button">
		<?php echo $form->labelEx($model,'top_season'); ?>
		<div class = "radio_button">
		<?php 
			if(!isset($model->top_season)) {
				$model->top_season = 0;
			}
			echo $form->radioButtonList($model,'top_season',array('0'=>'Не отображается', '1'=>'Выводится'), array('separator'=>'<br/>'));
		?>
		<?php echo $form->error($model,'top_season'); ?>
		</div>
	</div>
	<div class="row radio_button">
		<?php echo $form->labelEx($model,'slider_view'); ?>
		<div class = "radio_button">
		<?php 
			if(!isset($model->slider_view)) {
				$model->slider_view = 0;
			}
			echo $form->radioButtonList($model,'slider_view',array('0'=>'Не отображается', '1'=>'Выводится'), array('separator'=>'<br/>'));
		?>
		<?php echo $form->error($model,'slider_view'); ?>
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
			$path = Yii::getPathOfAlias('webroot').DS."upload".DS.Yii::app()->controller->module->id.DS.$model->id.".jpg";
			if(file_exists($path)){
				echo '<br/><img src = "/upload/'.Yii::app()->controller->module->id.'/'.$model->id.'.jpg" alt = "'.$model->name.'" />';
			}
		?>
	</div>
	<div class = "g-clear_fix"></div>
	
	<div class = "b-admin_catalog_tree j-catalog_tree">
	<?php 
		$catalogView = new TreeView($model->id);
		$catalogView ->formTree(-1);
	?>
	</div>
	<div class = "g-clear_fix"></div>
	<div class = "row">
	<?php 
	$this->widget('ext.EAjaxUpload.EAjaxUpload',
	array(
		'id'=>'uploadFile',
		'config'=>array(
			'action'=>'/shop/product/upload',
			'multiple'=> true,
			'debug' => true,
			'allowedExtensions'=>array("jpeg", "jpg", "png", "gif"),
			'sizeLimit'=>2*1024*1024,// maximum file size in bytes
			'minSizeLimit'=>1*1024,// minimum file size in bytes
			'onComplete'=>"js:function(id, fileName, responseJSON){ 
			}",
			'messages'=>array(
				'typeError'=>"{file} имеет недопустимое расширение. Только расширения {extensions} разрешены.",
				'sizeError'=>"{file} слишком большой. Максимальный размер {sizeLimit}.",
				'minSizeError'=>"{file} слишком маленький. Минимальный размер {minSizeLimit}.",
				'emptyError'=>"{file} пуст. Пожалуйста, повторите попытку",
				'onLeave'=>"Файлы загружаются, если Вы уйдете сейчас, то загрузка будет прекращена"
			),
			'showMessage'=>'js:function(message){$("#j-error_message").text(message)  }'
		)
));
	?>
	</div>
	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
	</div>
	<div id= "d-product_image" class = "d-product_image">
		<?php 
			echo '<p>Обложка товара:</p><br/>';
			if(is_file($imgDir.'thumbnails'.DIRECTORY_SEPARATOR.$model->front_image)) {
				echo '<img src = "/upload/product/'.$model->id.'/thumbnails/'.$model->front_image.'" alt = "обложка альбома"/>';			
			}
		?>
	</div>
	
	<?php
	$this->viewFileToDelete($imgDir, $model->id);?>
<?php $this->endWidget(); ?>

</div><!-- form -->