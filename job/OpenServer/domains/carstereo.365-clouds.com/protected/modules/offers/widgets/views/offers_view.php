
<div class="title-wrapper">
    <div class="section-title">
        <h4 class="gray-text title">Our <span class="red-text">Specials</span></h4>
    </div>
    <ul class="slidecontrols">
        <li><a href="#sliderName" class="next">Next</a></li>
        <li><a href="#sliderName" class="prev">Prev</a></li>
    </ul>
    <span class="divider"></span>
    <div class="clear"></div>
</div>

<ul class="slider carousel" id="sliderName">
    <li class="slide">
        <?php foreach($dataProvider as $data) { 
            $path = Yii::getPathOfAlias('webroot').DS."upload".DS."offers".DS.$data->id.".png";
            if(file_exists($path))
                $src = '<img src = "/upload/offers/'.$data->id.'.png" title = "'.$data->name.'" alt = "'.$data->name.'" />';
            else
                $src = '';
        ?>
        
            <div class="one-third column portfolio-item">               
                <?=$src;?>
                <a href="#" class="prettyPhoto zoom"></a>
                <a class="link" href="#"></a>
            </div>
        
        <?php }?>
    </li>
</ul>
