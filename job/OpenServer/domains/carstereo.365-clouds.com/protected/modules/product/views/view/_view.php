<?php 
    $cs=Yii::app()->clientScript;
    $cs->registerCssFile(Yii::app()->baseUrl . '/css/product.css');    
    $cs->registerCssFile(Yii::app()->baseUrl . '/css/gallery.css'); 
?>
<?php /*
	$path = Yii:/etPathOfAlias('webroot').DS."upload".DS."product".DS.$data->id.".jpg";
	if(file_exists($path))
		$src = '<img src = "/upload/product/'.$data->id.'.jpg" title = "'.$data->name.'" alt = "'.$data->name.'" />';
	else
		$src = 'hjjhjj';*/
	
?>
<?php 
	$path = Yii::getPathOfAlias('webroot').DS."upload".DS.Yii::app()->controller->module->folder.DS.$data->id.".jpg";
	if(file_exists($path))
		$src = '<img src = "/upload/'.Yii::app()->controller->module->folder.'/'.$data->id.'.jpg" title = "'.$data->name.'" alt = "'.$data->name.'" />';
	else
		$src = '';
?>
<div class="span4 block-100">
    <?=$src;?><p></p>
    <p class="p"><?=$data->name;?></p>
    <p class="color-red">$<?=$data->price;?></p>
    <p><?=$data->content;?></p>
</div>
           
             