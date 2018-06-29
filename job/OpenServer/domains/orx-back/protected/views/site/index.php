<?php 
if($model->seo_title == '')
	$seoTitle = $model->name;
else 
	$seoTitle = $model->seo_title;
$this->seo($seoTitle, $model->seo_keywords, $model->seo_description);
?>
		<section class = "b-video">
			<?php 
				$block = Block::viewBlock(7);
				foreach($block as $view){
					echo '<section class = "b-video_wrap">'.$view['description'];
					echo '</section>';
				}
			?>
			</section>
			<div class = "g-clear_fix"></div>
			<?php $this->widget('application.modules.stock.widgets.StockWidget', array('id'=>1))?>
			
			<section class = "b-preview">
			<?php 
				$block = Block::viewBlock(6);
				foreach($block as $view){
					echo $view['description'];
					echo '<div class = "g-clear_fix"></div>';
				}
			?>
			</section>
			
			<div class = "g-clear_fix"></div>
			<section class = "b-main_sliders">
				<div class = "b-main_slider1 j-slider">
					<div class = "slider_title_wrap">
						<a href = "<?php echo Yii::app()->createUrl('shop/product/popular');?>" class = "slider_title">
							популярные
						</a>
					</div>
					<div class = "g-clear_fix"></div>
					<ul id = "women_slider" class="jcarousel-skin-tango">
						<?php echo $this->sliderView($dataProvider, 'popular'); ?>
					</ul>
				</div>
				<div class = "b-main_slider2 j-slider">
					<div class = "slider_title_wrap">
						<a href = "<?php echo Yii::app()->createUrl('shop/product/share');?>" class = "slider_title">
							акция
						</a>
					</div>
					<div class = "g-clear_fix"></div>
					<ul id = "man_slider" class="jcarousel-skin-tango">
						<? echo $this->sliderView($dataProvider, 'in_stock');?>
					</ul>
				</div>
				<div class = "b-main_slider3 j-slider">
					<div class = "slider_title_wrap">
						<a href = "<?php echo Yii::app()->createUrl('shop/product/new');?>" class = "slider_title">
							новинки
						</a>
					</div>
					<div class = "g-clear_fix"></div>
					<ul id = "child_slider" class="jcarousel-skin-tango">
						<? echo $this->sliderView($dataProvider, 'new');?>
					</ul>
				</div>
			</section>
