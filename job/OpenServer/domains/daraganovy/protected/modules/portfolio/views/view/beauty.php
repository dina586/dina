<div class = "block full clearfix">
	<a class = "btn btn-success" href = "<?=Yii::app()->createUrl('/portfolio/view/admin') ?>">Сохранить и вернуться к портфолио</a>
	<a class = "btn btn-info" href = "<?=Helper::seoLink($model->id, get_class($model)) ?>">Сохранить и посмотреть пост</a>
	<p>Формат фото 1024x768</p>
	<?php
	$id = $model->isNewRecord ? -1 : $model->id;
	$this->widget('file_uploader.UploadWidget', array(
		'postParams' => array(
			'thumbnail' => array('width' => 250, 'height' => 250),
			'origial' => array('width' => 1280, 'height' => 960),
			'id' => $id,
			'name' => 'Porfolio_Beauty',
			'file_type' => 'image',
			'cover' => false,
		),
	));
	?>
	<?php $this->widget('file_uploader.FormWidget', array('id' => $id, 'modelName' => 'Porfolio_Beauty', 'cover' => false,)); ?>
</div>
