<?php 
if(count($dataProvider)>0):
?>
<div id="content-wrapper">
	<div class = "slider-full-width clearfix" >
		<!-- Place somewhere in the <body> of your page -->
		<div class="epic-slider" data-slider-type="featured">	 
			
			<ul id="slides">
										
				<?php foreach($dataProvider as $data) { 
				
				?>
				<li data-image="/upload/<?=Yii::app()->getModule('slider')->frontFolder;?>/<?=$data->id;?>.jpg" data-image-retina="upload/<?=Yii::app()->getModule('slider')->frontFolder;?>/<?=$data->id;?>.jpg">
				
                <div class="es-caption" data-caption="impact" data-caption-position="center" data-caption-width="700">
                    <!--<span class="size-2">WOLF HTML TEMPLATE</span>
                    <p>A minimalist, retina ready template for design studios and creatives.</p>-->
                    </div>
                   <!-- <div class="es-caption-mobile">
                    <p>A minimalist, retina ready template for design studios and creatives.</p>
                    </div>-->
                </li>

				<?php }?>				
			
			</ul>
		</div>
	</div>
</div>


<?php 

endif;
?>