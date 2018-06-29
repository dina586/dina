<?php 
	$path = Yii::getPathOfAlias('webroot').DS."upload".DS."news".DS.$data->id.".jpg";
	if(file_exists($path))
		$src = '<img src = "/upload/news/'.$data->id.'.jpg" title = "'.$data->name.'" alt = "'.$data->name.'" />';
	else
		$src = '<img src = "/images/no-img.png" title = "" alt = "" />';
?>

<? //$src = '/upload/news/'.$data->id.'.jpg'; ?>
<div class="col-sm-6 branding element">                    
    <div class="item animate" data-anim-type="bounceIn" data-anim-delay="250">
        <div class="item_wrapper">                                  
            <div class="img_block wrapped_img">
                <?=$src;?>
                <span class="block_fade"></span>
                <div class="post_hover_info">
                    <div class="featured_items_title">
                        <h5><?=$data->name;?></h5>
                    </div>
                    <a href = "<?=Yii::app()->createUrl('news/view/view', array('url'=>$data->url));?>" class="featured_ico_link view_link"><i class="icon-expand"></i></a>
                </div>
            </div>                                                                                                            
        </div>
    </div>                                  
</div>