<div class = "d-file_manager_items b-file_manager_items" id = "d-file_manager_items" data-m-id = "<?=$this->id;?>" data-m-name = "<?=$this->modelName;?>">
<?php
if(count($dataprovider)>0):
	foreach($dataprovider as $data)
		Yii::app()->controller->renderPartial('file_uploader.views._image', array('data'=>$data, 'cover'=>$this->cover));
endif;
?>
</div>