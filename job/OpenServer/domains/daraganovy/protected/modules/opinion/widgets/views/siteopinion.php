<section class="fullwidth-content-section-background">
	<h6 class="centered-text">отзывы о нас</h6>
	<section class="content-section clearfix">
		<?php
		foreach ($dataProvider as $data) {
			?>
			<div class="column_one_third">
				<div class="thumb left">
					<a class="lightbox" href="/upload/opinion/<?=$data->id; ?>.jpg">
						<img src="/upload/opinion/<?=$data->id; ?>.jpg"/>
					</a>
				</div>
				<div class="boxed-content margin-bottom-none">
					<h5><?=$data->name; ?></h5>
					<p><?=$data->content; ?></p>
				</div>
			</div>
		<?php } ?>

		<div class="clear"></div>

	</section>
	<div class="section-btn">
		<a href="<?=Yii::app()->createUrl('opinion/view/index'); ?>">
			<?=Fields::submitBtn('смотреть отзывы'); ?>  
		</a>
	</div>  
</section>