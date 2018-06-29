<?php 
	/*$wrapper = $index%2? 'b-opinion_right' : 'b-opinion_left';
	$path = Yii::getPathOfAlias('webroot').DS."upload".DS.Yii::app()->controller->module->folder.DS.$data->id.".jpg";
	$alt = str_replace(array("'", '"'), "", $data->name);
	if(file_exists($path)) {
		$img = '<img src = "/upload/'.Yii::app()->controller->module->folder.'/'.$data->id.'.jpg" title = "'.$alt.'" alt = "'.$alt.'" />';
	}
	else {
		$img = '';
	}*/
	
	/*$path = Yii::getPathOfAlias('webroot').DS."upload".DS."article".DS.$data->id.".jpg";
	if(file_exists($path))
		$src = '<img src = "/upload/opinion/'.$data->id.'.jpg" title = "'.$data->name.'" alt = "'.$data->name.'" />';
	else
		$src = '<img src = "/images/no-img.png" title = "" alt = "" />';*/
?>

<div class = "comment">
	<div class="comment-img">
		<img src="/upload/opinion/<?=$data->id;?>.jpg"/>
	</div>
	<div class="comment-text">
		
		<article class = "g-styles">
			<?php if($data->name!=''):?>
				<h2><?=$data->name;?></h2>
			<?php endif;?>
			<?=$data->content;?>
		</article>
	</div>
</div>