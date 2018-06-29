<?php 
	$path = Yii::getPathOfAlias('webroot').DS."upload".DS."technics".DS.$data->id.".jpg";
	if(file_exists($path))
		$src = '<img src = "/upload/technics/'.$data->id.'.jpg" title = "'.$data->name.'" alt = "'.$data->name.'" />';
	else
		$src = '<img src = "/images/no-img.png" title = "" alt = "" />';
?>

<div class="branding element">                    
    <div class="item animate" data-anim-type="fadeInDown" data-anim-delay="300">
    	<div class="item_wrapper">
            <div class="img_block wrapped_img">
                <?=$src;?>
                <span class="block_fade"></span>
                <div class="post_hover_info">
                    <div class="featured_items_title">
                        <h5><a href="<?=Yii::app()->createUrl('technics/view/view', array('url'=>$data->url));?>"><?=$data->name;?></a></h5>
                    </div>
                    <a href="<?=Yii::app()->createUrl('technics/view/view', array('url'=>$data->url));?>" class="featured_ico_link view_link"><i class="icon-expand"></i></a>
                </div>
            </div>
        </div>
    </div>                                   
</div>