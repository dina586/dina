<!--<ul  class="jcarousel-skin-tango">
            
                <li><a href="http://www.ecocity.by" target = "_blank"><img alt="Экология города " title="pairs1" src="http://www.ecocity.by/images/logo.png"/></a></li>
                <li><a href="http://slav.by/" target = "_blank"><img alt="pairs2" title="pairs2" src="http://slav.by/images/LOGO%20NEW.png"/></a> </li>
                <li><a href="http://www.falcone.by/" target = "_blank"><img alt="Falcon" title="pairs2" src="http://static.wixstatic.com/media/aa19d8_1043e71988de4fa4a2a615b189bdbd67.gif"/></a> </li>
            <img src = "/images/no-img.png"/>                  
</ul>-->


<ul>
    <?php foreach($dataProvider as $data) { 
         $path =  ROOT_PATH.DIRECTORY_SEPARATOR."upload".DIRECTORY_SEPARATOR."partner".DIRECTORY_SEPARATOR.$data->id.".jpg";
        
         if(file_exists($path))
             $img = '<img src="/upload/partner/'.$data->id.'.jpg" alt="'.$data->name.'" title="'.$data->name.'"/>';
			
        ?>
    <li><a href="<?=$data->link?>" target = "_blank"><?=$img?></a></li>
    <?php }?>
</ul>
