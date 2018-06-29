<?php 
$this->widget('ext.EAjaxUpload.EAjaxUpload',
	array(
		'id'=>'uploadFile',
		
			'config'=>array(
				'action'=>''.Yii::app()->createUrl("/".$this->module->id."/".Yii::app()->controller->id."/upload").'',
				'multiple'=> true,
				'debug' => true,
				'allowedExtensions'=>array("jpeg", "jpg", "png", "gif"),
				'sizeLimit'=>1*1024*1024,// maximum file size in bytes
				'minSizeLimit'=>1*1024,// minimum file size in bytes
				//'onComplete'=>"js:function(id, fileName, responseJSON){ alert(fileName); }",
				'messages'=>array(
					'typeError'=>"{file} has invalid extension. Only {extensions} are allowed.",
					'sizeError'=>"{file} is too large, maximum file size is {sizeLimit}.",
					'minSizeError'=>"{file} is too small, minimum file size is {minSizeLimit}.",
					'emptyError'=>"{file} is empty, please select files again without it.",
					'onLeave'=>"The files are being uploaded, if you leave now the upload will be cancelled."
				),
				//'showMessage'=>"js:function(message){ alert(message); }"
			)
));
$this->viewFileToDelete(ROOT_PATH.DIRECTORY_SEPARATOR.'upload'.DIRECTORY_SEPARATOR.'gallery'.DIRECTORY_SEPARATOR);

?>
