<?php 
	
	
?>
<div class="title-wrapper">
    <div class="section-title">
        <h4 class="title"><span class="red-text">Specials</span> <span class="gray-text">We Carry</span></h4>
    </div>
    <ul class="slidecontrols">
        <li><a href="#clientSlider" class="next">Next</a></li>
        <li><a href="#clientSlider" class="prev">Prev</a></li>
    </ul>
        <span class="divider"></span>
    <div class="clear"></div>
</div>

    <ul class="slider carousel" id="clientSlider">
        
        <?php
        
            $size = count($dataProvider);
            for ($i = 0; $i < $size; $i++) 
            {
                $path = Yii::getPathOfAlias('webroot').DS."upload".DS."carriers".DS.$dataProvider[$i]['id'].".jpg";
                if(file_exists($path))
                    $src0 = '<img src = "/upload/carriers/'.$dataProvider[$i]['id'].'.jpg" title = "'.$dataProvider[$i]['name'].'" alt = "'.$dataProvider[$i]['name'].'" />';
                else
                    $src0 = '';
                
                $path = Yii::getPathOfAlias('webroot').DS."upload".DS."carriers".DS.$dataProvider[$i+1]['id'].".jpg";
                if(file_exists($path))
                    $src1 = '<img src = "/upload/carriers/'.$dataProvider[$i+1]['id'].'.jpg" title = "'.$dataProvider[$i+1]['name'].'" alt = "'.$dataProvider[$i+1]['name'].'" />';
                else
                    $src1 = '';
                
                $path = Yii::getPathOfAlias('webroot').DS."upload".DS."carriers".DS.$dataProvider[$i+2]['id'].".jpg";
                if(file_exists($path))
                    $src2 = '<img src = "/upload/carriers/'.$dataProvider[$i+2]['id'].'.jpg" title = "'.$dataProvider[$i+2]['name'].'" alt = "'.$dataProvider[$i+2]['name'].'" />';
                else
                    $src2 = '';
                
                $i = $i+2;
                ?>

                <li class="slide">
                    <div class="client alpha ">
                        <a href="#"><?=$src0;?></a>
                    </div>  
                    <div class="client beta">
                        <a href="#"><?=$src1;?></a>
                    </div>
                    <div class="client delta">
                        <a href="#"><?=$src2;?></a>
                    </div>                
                </li>  
                    
        <?php } ?>
            
    </ul>
