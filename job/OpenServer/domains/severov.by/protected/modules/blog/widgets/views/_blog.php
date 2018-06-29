<?php 
	$path = Yii::getPathOfAlias('webroot').DS."upload".DS."blog".DS.$data->id.".jpg";
	if(file_exists($path))
		$src = '<img src = "/upload/blog/'.$data->id.'.jpg" title = "'.$data->name.'" alt = "'.$data->name.'" />';
	else
		$src = '<img src = "/images/no-img.png" title = "" alt = "" />';
?>

<li class="with_img">
    <div class="recent_posts_content">
    	<?=$src;?>
        <a href="<?=Yii::app()->createUrl('blog/view/view', array('url'=>$data->url));?>" class="title"><?=$data->name;?></a>
        <div class="recent_posts_info"><?=$data->date;?></div>
    </div>                                    
</li> 