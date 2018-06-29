



<div class = "c-right_column">

    <div class = "g-link2">
		<a href = "<?=Yii::app()->createUrl('/shop/product/popular') ?>"><img src = "/images/hit.jpg" /></a>
		<p>ТОП</p>
		<p>СЕЗОНА</p>
    </div>
    <div class = "g-clear_fix"></div>
    <div class="b-booking">
        <a href="#" class = "j-show_call_dialog"><img alt="booking" src="/images/booking.png" title="booking"/></a>
    </div>
    <div class = "g-clear_fix"></div>
    <div class="b-right-div">
        <p>НАШИ партнеры</p>                            
    </div>
    <div class="b-right-div-img">
        <div class="b-div-img" id = "partners_slider">
            
             <?php $this->widget('application.modules.shop.widgets.PartnerSliderWidget')?>
            
        </div>
        <a class="jcarousel-prev" href="#"></a>
        <a class="jcarousel-next" href="#"></a> 
    </div>
    <div class = "g-clear_fix"></div>
   
    <div class = "b-vkontakte">
		 <div class="b-right-div">
			<p>МЫ в контакте</p>                            
		</div>
		<script type="text/javascript" src="//vk.com/js/api/openapi.js?105"></script>
		<!-- VK Widget -->
		<div id="vk_groups"></div>
		<script type="text/javascript">
            VK.Widgets.Group("vk_groups", {mode: 0, width: "278", height: "400", color1: 'FFFFFF', color2: '2B587A', color3: '5B7FA6'}, 60518876);
		</script>	
    </div>
    <div class = "g-clear_fix"></div>
    <div class = "b-main_opinions">
		<h3>ОТЗЫВЫ</h3>
		<?php
		$view = Opinions::lastOpinions();
		$url = '<a href = "'.Yii::app()->createUrl('opinions').'"><br/>подробнее</a>';
		foreach ($view as $value) {
			$img = '';
			if (file_exists(ROOT_PATH.'/upload/opinions/'.$value['id'].'.jpg')) {
				$img = '<img src = "/upload/opinions/'.$value['id'].'.jpg">';
			}
			$date = Yii::app()->dateFormatter->format('dd.MM.yy', $value['date']);
			$text = cText::word_trim($value['text'], 20, $url);
			echo '<section class = "b-opinion">
                            <figure>
                                    <a href = "'.Yii::app()->createUrl('opinions').'">'.$img.'</a>
                                    <figcaption>
                                            <span>'.$date.'</span>
                                            <span>'.$value['name'].'</span>
                                            <p>
                                                    '.$text.'
                                            </p>
                                    </figcaption>
                            </figure>
                    </section>
                    <div class = "g-clear_fix"></div>';
		}
		?>				
    </div>
    <div class = "g-clear_fix"></div>
    <div class = "g-link2">
		<a href = "<?=Yii::app()->createUrl('/shop/product/popular') ?>"><img src = "/images/tih.jpg" /></a>
		<p><span  class="f23size">весенние и летние</span></p>
		<p><span  class="f30size">СКИДКИ 50%</span></p>
    </div>

</div>