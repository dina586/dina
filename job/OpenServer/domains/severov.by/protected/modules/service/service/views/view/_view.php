<?php 
	$path = Yii::getPathOfAlias('webroot').DS."upload".DS."service".DS.$data->id.".jpg";
	if(file_exists($path))
		$src = '<img src = "/upload/service/'.$data->id.'.jpg" title = "'.$data->name.'" alt = "'.$data->name.'" />';
	else
		$src = '';
?>
<div class="col-sm-12 branding element">                    
    <div class="portfolio_item item">
    	<div class="row">
            <div class="col-sm-4 pb7">
                <div class="img_block wrapped_img">
                    <?=$src;?>
                    <span class="block_fade"></span>
                    <div class="post_hover_info">
                        <a href="<?=Yii::app()->createUrl('service/', array('url'=>$data->url));?>" class="photozoom featured_ico_link view_link"><i class="icon-expand"></i></a>
                    </div>                                                            
                </div>
            </div>
            <div class="col-sm-8">
                <h2 class="portf_title"><a href="<?=Yii::app()->createUrl('service/view/view', array('url'=>$data->url));?>"><?=$data->name;?></a></h2>

                <p><?=$data->description;?></p>                                                                                                                      
            </div>                                        
        </div>                                                                        	
    </div>                                   
</div>
<div class="clear"></div>
                                
                        