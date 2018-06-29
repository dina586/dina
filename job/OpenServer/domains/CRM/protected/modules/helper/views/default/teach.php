<div class = "block full clearfix">
	<?php
	$this->widget('file_uploader.UploadWidget', array(
		'postParams' => array(
			'thumbnail' => array('width' => 350, 'height' => 280),
			'id' => 2,
			'name' => 'UploadData',
			'file_type' => 'image',
			'cover'=>false,
		),
	));
	?>
	<?php $this->widget('file_uploader.FormWidget', array('id' => 2, 'modelName' => 'UploadData', 'cover'=>false)); ?>
</div>