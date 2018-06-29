<?php
foreach ($dataProvider as $data) {
	?>
	<?php
	$url = Helper::seoLink($data->id, get_class($data));

	$imgPath = Helper::getCover($data->id, get_class($data));

	if ($imgPath == "")
		$imgPath = "/images/no-img.png";
	?>

	<div class="thumb masonry-item" data-project-categories="photography">
		<a href="<?=$url; ?>" title="" data-caption="">			
			<img src="<?=$imgPath; ?>" alt="">			
		</a>
	</div>

<?php } ?>
                                

