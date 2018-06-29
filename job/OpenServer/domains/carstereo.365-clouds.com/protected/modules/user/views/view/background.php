<div class = "block full clearfix">
	<p><?=Yii::t('admin', 'Please, upload an image with the size 2000x300 for better displaying');?></p>
	<?php
	$this->widget('file_uploader.UploadWidget', array(
		'uploadButtonText'=>Yii::t('admin', 'Click here to upload new background'),
		'dragText'=>Yii::t('admin', 'Drop image here to upload'),
		'multiple'=>false,
		'postParams' => array(
			'thumbnail' => array('width' => 500, 'height' => 150, 'type'=>'crop'),
			'original' => array('width' => 2000, 'height' => 300, 'type'=>'crop'),
			'id' => $model->id,
			'name' => 'UserBackground',
			'file_type' => 'image',
		),
	));
	?>
	
	<h3><?=Yii::t('admin', 'Available backgrounds')?>:</h3>
	<?php $this->widget('file_uploader.FormWidget', array('id' => $model->id, 'modelName' => 'UserBackground')); ?>
</div>
