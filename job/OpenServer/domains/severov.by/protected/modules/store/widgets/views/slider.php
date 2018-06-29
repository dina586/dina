<?php 
if(count($dataProvider)>0):
?>
	<div class = "b-front_jcarousel_wrap">
		<div class = "l-jcarousel j-jcarousel_shop b-shop_product_slider">
			<ul>
			<?php foreach($dataProvider as $data) { 
				Yii::app()->controller->renderPartial('application.modules.store.views.product._view', array('data'=>$data, 'jClass'=>'j_shop_slider', 'index'=>2));
			 }?>
			</ul>

		</div>
		<a href="#" class="b-jcarousel_control b-control-prev j-jcarousel_shop-control-prev"></a>
		<a href="#" class="b-jcarousel_control b-control-next j-jcarousel_shop-control-next"></a>
	</div>
<?php 

JS::add('jcarousel_init_shop_slider_'.$this->sliderType, 'jcarousel_init(".j-jcarousel_shop", '.Settings::getVal('slider_scroll_speed').')');		
JS::add('page_styles_'.$this->sliderType, 'pageStyles('.count($dataProvider).')');
endif;
?>
