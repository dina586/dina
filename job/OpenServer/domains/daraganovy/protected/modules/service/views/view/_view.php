<?php 
	$path = Yii::getPathOfAlias('webroot').DS."upload".DS."service".DS.$data->id.".jpg";
	if(file_exists($path))
		$src = '<img src = "/upload/service/'.$data->id.'.jpg" title = "'.$data->name.'" alt = "'.$data->name.'" />';
	else
		$src = '';
?>
<div class = "comment">		
    <section class="content-section clearfix">
	<div class="content-inner-left">
				<!--Start Post -->
            <article class="blog-post">
		<div class="blog-post-content">
                    <div class="blog-post-featured-media-p">
			<?=$src;?>
                    </div>
                    <h2><?=$data->name;?></h2> 
                   <p><?=$data->content;?></p> 
                    <div class="clear"></div>
                    
		</div>
            </article>	
        </div>
    </section>
</div>
                                
                        