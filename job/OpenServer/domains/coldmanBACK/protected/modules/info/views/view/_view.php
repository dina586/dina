<?php 
	$path = Yii::getPathOfAlias('webroot').DS."upload".DS.Yii::app()->controller->module->folder.DS.$data->id.".jpg";
	if(file_exists($path))
		$img = '<img src = "/upload/'.Yii::app()->controller->module->folder.'/'.$data->id.'.jpg" title = "'.$data->name.'" alt = "'.$data->name.'" />';
	else
		$img = '';
?>

<div class = "l-item b-<?=Yii::app()->controller->module->id;?>_preview">
	
	<a class = "l-item_image" href = "<?=Yii::app()->createUrl(Yii::app()->controller->module->id.'/view/view', array('url'=>$data->url));?>"><?=$img;?></a>
	
	<time datetime="<?=Yii::app()->dateFormatter->format("yyyy-MM-dd", $data->date);?>">
		<?=Yii::app()->dateFormatter->format(Yii::app()->locale->getDateFormat(), $data->date);?>
	</time>
	
	<a class = "l-item_title" href = "<?=Yii::app()->createUrl(Yii::app()->controller->module->id.'/view/view', array('url'=>$data->url));?>"><?=$data->name;?></a>
	
	<p><?=$data->description;?></p>

</div>