<?php 
	$path = Yii::getPathOfAlias('webroot').DS."upload".DS."blog".DS.$data->id.".jpg";
	if(file_exists($path))
		$src = '<img src = "/upload/blog/'.$data->id.'.jpg" title = "'.$data->name.'" alt = "'.$data->name.'" />';
	else
		$src = '';
?>
<div class="col-sm-12 branding element">                    
    <div class="portfolio_item item">
    	<div class="row">
            <div class="col-sm-6 pb7">
                <div class="img_block wrapped_img">
                    <?=$src;?>
                    <span class="block_fade"></span>
                    <div class="post_hover_info">
                        <a href="<?=Yii::app()->createUrl('blog/view/view', array('url'=>$data->url));?>" class="photozoom featured_ico_link view_link"><i class="icon-expand"></i></a>
                    </div>                                  
                </div>
            </div>
            <div class="col-sm-6">
                <h2 class="portf_title"><a href="<?=Yii::app()->createUrl('blog/view/view', array('url'=>$data->url));?>"><?=$data->name;?></a></h2>
                <div class="listing_meta">
                    <span><?=$data->date;?></span>
                </div>
                <p><?=$data->description;?></p>                                                                                                                      
            </div>                                        
        </div>                                                                        	
    </div>                                   
</div>
<div class="clear"></div>
                                
                        