<?php 
	$url = Yii::app()->createUrl(Yii::app()->controller->module->id.'/'.Yii::app()->controller->id.'/view', array('url'=>$data->url));

	$path = Yii::getPathOfAlias('webroot').DS."upload".DS.Yii::app()->controller->module->folder.DS.$data->id.".jpg";
	if(file_exists($path)) {
		$img = '<div class = "col-md-4 b-trade_img"><a href = "'.$url.'"><img src = "/upload/'.Yii::app()->controller->module->folder.'/'.$data->id.'.jpg" title = "'.$data->name.'" alt = "'.$data->name.'" /></a></div>';
		$class = "col-md-8";
	} else {
		$class = "col-md-12";
		$img = '';
	}
	$description = preg_replace('/(<br \/>){2,}/', '<br />', $data->description);
?>
<div class = "b-trade_preview border_box">
	<?=$img?>
	<div class = "<?=$class?> b-trade_preview_content">
		<a href = "<?=$url;?>" class = "l-item_title"><?=$data->name?></a>
		<p><?=$description?></p>
	
		<div class = "b-trade_preview_btns">
			<a class = "btn" href = "<?=$url;?>">Details</a>
			<a class = "btn" href = "#">Contact Us</a>
		</div>
	</div>
</div>

