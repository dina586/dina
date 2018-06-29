<?php 
	$wrapper = $index%2? 'b-opinion_right' : 'b-opinion_left';
	$path = Yii::getPathOfAlias('webroot').DS."upload".DS.Yii::app()->controller->module->folder.DS.$data->id.".jpg";
	$alt = str_replace(array("'", '"'), "", $data->name);
	if(file_exists($path)) {
		$img = '<img src = "/upload/'.Yii::app()->controller->module->folder.'/'.$data->id.'.jpg" title = "'.$alt.'" alt = "'.$alt.'" />';
		$class = "b-opinion_text";
	}
	else {
		$class = $img = '';
	}
?>

<div class = "l-item b-<?=Yii::app()->controller->module->id;?>_preview <?=$wrapper?>">
	<?=$img?>
	
	<section class = "<?=$class?>">
		
		<article class = "g-styles">
			<?php if($data->name!=''):?>
			<h2><?=$data->name;?></h2>
			<?php endif;?>
			<?=$data->content;?>
		</article>
		
	</section>
	<section class = "b-corner"></section>
</div>