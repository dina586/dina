<!-- Content Area -->
<div id="content-wrapper">


	<!-- Epic Slider -->

	<?php
	$this->widget('application.modules.slider.widgets.FrontSliderWidget');
	?>
	<section class="content-section clearfix">

		<h1 class="underlined"><?=$model->name; ?></h1>

		<p class="lead-paragraph">
			<?=$model->content; ?>
		</p>

	</section>

	<section class="fullwidth-content-section-background clearfix">
		<section class="content-section clearfix text-center">
			<h2>Фотогалерея</h2>
			<div class="clear"></div>
		</section>

		<div class="recent-work fullwidth">
			<div class="portfolio fullwidth">				  
				<div class="grid masonry five-column clearfix">
					<?php $this->widget('application.modules.portfolio.widgets.SiteGalleryWidget', array('type' => 0)); ?>
				</div>
			</div>
			<div class="view-more-container">
				<a href="<?=Yii::app()->createUrl('/portfolio/view/index', ['type'=>'photo']); ?>" class="submit" title="">Больше работ</a>
			</div>
		</div>
	</section>

	<section class="fullwidth-content-section clearfix">
		<section class="content-section clearfix text-center">
			<h2>Видеогалерея</h2>
			<div class="clear"></div>
		</section>

		<div class="recent-work fullwidth">
			<div class="portfolio fullwidth">				
				<div class="grid masonry five-column clearfix">
					<?php $this->widget('application.modules.portfolio.widgets.SiteGalleryWidget', array('type' => 1)); ?>				
				</div>
			</div>
			<div class="view-more-container">
				<a href="<?=Yii::app()->createUrl('/portfolio/view/index', ['type'=>'video']); ?>" class="submit" title="">Больше работ</a>
			</div>
		</div>
	</section>


	<section class="fullwidth-content-section-background-image background-image-1 clearfix">

		<section class="content-section clearfix">
			<div class = "lead">
			<?php $this->widget('application.modules.block.components.GetBlocks', array('view' => 'front_block', 'tag'=>'h2')); ?>
			<div class="clear"></div>
			</div>

		</section>

	</section>

	<?php $this->widget('application.modules.opinion.widgets.SiteOpinionWidget'); ?> 
</div>