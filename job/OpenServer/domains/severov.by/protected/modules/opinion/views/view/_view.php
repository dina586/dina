<?php 
	$wrapper = $index%2? 'b-opinion_right' : 'b-opinion_left';
	$path = Yii::getPathOfAlias('webroot').DS."upload".DS.Yii::app()->controller->module->folder.DS.$data->id.".jpg";
	$alt = str_replace(array("'", '"'), "", $data->name);
	if(file_exists($path)) {
		$img = '<img src = "/upload/'.Yii::app()->controller->module->folder.'/'.$data->id.'.jpg" title = "'.$alt.'" alt = "'.$alt.'" />';
	}
	else {
		$img = '';
	}
?>

<div class = "comment">
	<div class="comment-img">
		<?=$img?>
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