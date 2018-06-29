<?php 
if($model->seo_title == '')
	$seoTitle = $model->name;
else 
	$seoTitle = $model->seo_title;
$this->seo($seoTitle, $model->seo_keywords, $model->seo_description);
?>

<div class = "g-slider_area">	
		<div class = "g-slider">
			<?php 
				$data = Product::sliderDataMain();
				if(count($data)>0){
			?>
				<ul class="jcarousel-skin-tango">
					<?php
						foreach($data as $view) {
							
							$url = Yii::app()->createUrl('shop/product/view', array('url'=>$view['url']));
							 echo 	'<li>
										<a href = "'.$url.'">'.$view['name'].'</a>
										<img src = "/upload/shop/'.$view['id'].'.jpg"/>
									</li>';
						}
					?>
				</ul>
			<?php } else{
				echo '<img src = "/images/SLIDER.jpg"/>';
			}?>
		
		</div>
		
        <div class = "g-collection">
			<?php $data = Catalog::model()->findAll(array('condition'=>'view_on_main=1', 'order'=>'position', 'limit'=>4));
			if(count($data)>0) {
				foreach($data as $view) {
					$url = Yii::app()->createUrl('shop/catalog/view', array('url'=>$view->url));
					echo '<section style = "background:url('.Yii::app()->request->baseUrl.'/upload/catalog/'.$view->id.'.jpg)">
						<a href = "'.$url.'" class = "l-link">'.$view->name.'</a>
					</section>';
				}
			}
			?>
        </div>

		<!--<div class = "g-links">
			<section class = "g-link1">
				<a href = "<?//=Yii::app()->createUrl('/shop/catalog')?>" class = "l-link">
					<span>вся </span>
					коллекция 
				</a>
			</section>
			<div class = "g-link2">
				<a href = "<?//=Yii::app()->createUrl('/shop/product/share')?>">
					<img src = "/images/all_umbrella1.jpg" />
				</a>
				<?php /*
					$block = Block::viewBlock(2);
					foreach($block as $view){
						echo $view['description'];
						echo '<div class = "g-clear_fix"></div>';
					}*/
				?>
			</div>
		</div>-->
</div>

<div class = "g-clear_fix"></div>

<div class = "c-left_column">
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

    <!--<section class = "b-preview">
            <?php /*
                    $block = Block::viewBlock(6);
                    foreach($block as $view){
                            echo $view['description'];
                            echo '<div class = "g-clear_fix"></div>';
                    }
            */?>
    </section>-->

    <div class = "g-clear_fix"></div>
    <section class = "b-main_sliders">
        <div class = "b-main_slider1 j-slider">
            <div class = "slider_title_wrap">
                <a href = "<?php echo Yii::app()->createUrl('shop/product/popular');?>" class = "slider_title">
                        популярные
                </a>
            </div>
            <div class = "g-clear_fix"></div>
            <div id="women_slider">
                <ul class="jcarousel-skin-tango">
                        <?php echo $this->sliderView($dataProvider, 'popular'); ?>
                </ul>
            </div>
            <a class="jcarousel-prev" href="#"></a>
            <a class="jcarousel-next" href="#"></a> 
        </div>
        <div class = "b-main_slider2 j-slider">
            <div class = "slider_title_wrap">
                <a href = "<?php echo Yii::app()->createUrl('shop/product/share');?>" class = "slider_title">
                        акция
                </a>
            </div>
            <div class = "g-clear_fix"></div>
            <div id="man_slider">
                <ul class="jcarousel-skin-tango">
                        <?php echo $this->sliderView($dataProvider, 'in_stock');?>
                </ul>
            </div>
            <a class="jcarousel-prev" href="#"></a>
            <a class="jcarousel-next" href="#"></a> 
        </div>
        <div class = "b-main_slider3 j-slider">
            <div class = "slider_title_wrap">
                <a href = "<?php echo Yii::app()->createUrl('shop/product/new');?>" class = "slider_title">
                        новинки
                </a>
            </div>
            <div class = "g-clear_fix"></div>
            <div  id = "child_slider" >
                <ul class="jcarousel-skin-tango">
                        <? echo $this->sliderView($dataProvider, 'new');?>
                </ul>
            </div>
            <a class="jcarousel-prev" href="#"></a>
            <a class="jcarousel-next" href="#"></a> 
        </div>
    </section>
    <div class = "g-clear_fix"></div>
    <section class = "b-preview">
            <?php 
                    $content = Content::model()->findByPk(4);
                    echo $content->description; 
            ?>
    </section>
</div>
<?php $this->renderPartial('application.views.layouts.right_column');?>