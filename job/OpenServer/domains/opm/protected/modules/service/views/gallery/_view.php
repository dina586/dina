<?php 
	$url = Yii::app()->createUrl(Yii::app()->controller->module->id.'/'.Yii::app()->controller->id.'/view', array('url'=>$data->url));

	$path = Yii::getPathOfAlias('webroot').DS."upload".DS.Yii::app()->controller->module->folder.DS.$data->id.".jpg";
	$img = Helper::getCover($data->id, get_class($data), $url);
	$description = preg_replace('/(<br \/>){2,}/', '<br />', $data->description);
?>
<div class = "b-trade_preview border_box">
	<div class = "col-md-4 b-trade_img">
		<?=$img?>
	</div>
	<div class = "col-md-8 b-trade_preview_content">
		<a href = "<?=$url;?>" class = "l-item_title"><?=$data->name?></a>
		<p><?=$description?></p>
	
		<div class = "b-trade_preview_btns">
			<a class = "btn" href = "<?=$url;?>">Details</a>
			<a target = "_blank" class = "btn" href = "<?=Yii::app()->createUrl('/site/contact')?>">Contact Us</a>
		</div>
	</div>
</div>

