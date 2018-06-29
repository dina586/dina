<?php 
	$path = Yii::getPathOfAlias('webroot').DS."upload".DS."technics".DS.$data->id.".jpg";
	
	if(file_exists($path))
		$src = '<img src = "/upload/technics/'.$data->id.'.jpg" title = "'.$data->name.'" alt = "'.$data->name.'" />';
	else
		$src = '<img src = "/images/no-img.png" title = "" alt = "" />';
?>

<div class="col-sm-12 branding element">                    
    <div class="portfolio_item item">
    	<div class="row">
            <div class="col-sm-3">
				<div class="img_block wrapped_img">
					<a href="<?=Yii::app()->createUrl('technics/view/view', array('url'=>$data->url));?>"><?=$src;?></a>
                
                
                
				</div>
			</div>
			<div class="col-sm-8">
                <h2 class="portf_title"><a href="<?=Yii::app()->createUrl('technics/view/view', array('url'=>$data->url));?>"> <?=$data->name;?></a></h2>
                <p><?=$data->description;?></p> 
			</div>
        </div>
        </div>
    </div>                                   
<div class="clear"></div>