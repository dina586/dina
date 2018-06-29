<?php 
	$this->widget('file_uploader.UploadWidget', array(
		'action'=>Yii::app()->createUrl('store/parse/csvImport'),
		'multiple'=>false,
		'allowedExt'=>array('csv'),
	));
?>

<div id = "d-file_manager_items" class = "l-system_message"></div>

<div id = "j-error_message"></div>

