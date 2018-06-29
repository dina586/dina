<?php 
	$path = Yii::getPathOfAlias('webroot').DS."upload".DS."product".DS.$data->id.".jpg";
	if(file_exists($path))
		$img = '<img class="img-responsive rigthfloat" src = "/upload/product/'.$data->id.'.jpg" title = "'.$data->name.'" alt = "'.$data->name.'" />';
	else
		$img = '';
?>
<div class="offer whitecolor">
    <div class="container">
        <div class="box animated fadeInDown" data-animation-type="fadeInDown" data-animation-delay="0" style="animation-duration: 1s; visibility: visible;">
            
			<div class="dimgr">
                    <?=$img;?>
            </div>
            <div class="dcontent dcontent_left">
                    <p class="ofheaders">
                            <?=$data->name;?>
                    </p>
                    <p class="dtxt">
                        <?=$data->content;?>
                    </p>
                    <a>Узнать больше</a>
            </div>        
        </div>
    </div>    
</div>
