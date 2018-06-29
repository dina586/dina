<?php 
if($model->seo_title == '')
	$seoTitle = $model->name;
else 
	$seoTitle = $model->seo_title;
$this->seo($seoTitle, $model->seo_keywords, $model->seo_description);

$img = '';
if(file_exists(ROOT_PATH."/upload/about/thumbnails/".$model->id.".jpg")) {
	$img = '<section class = "b-product_preview b-product_details">
				<figure>
					<img src = "../../upload/about/thumbnails/'.$model->id.'.jpg"/>
				</figure>
			</section>';
}
?>
<div class = "b-product_view b-add_to_cart">
	<h3 class = "page_title"><?php echo $model->name;?></h3>
	<div class = "l-material">
		<div class = "b-about_view">
				<?=$img?>
				<article>
					<?php echo $model->description; ?>
				</article>
		</div>
	</div>
</div>

				