
<?php
$url = Helper::seoLink($data->id, get_class($data));

$imgPath = Helper::getCover($data->id, get_class($data), 'medium');

if ($imgPath == "")
	$imgPath = "/images/no-img.png";
?>

<article class="blog-post">
	<div class="blog-post-content">
		<?php
		if ($imgPath != false):
			?>
			<div class="thumb">
				<a title="<?=CHtml::encode($data->name); ?>" href="<?=$url; ?>" data-caption="<?=CHtml::encode($data->name); ?>">
					<img src="<?=$imgPath; ?>" alt="<?=CHtml::encode($data->name); ?>" />
				</a>
			</div>

		<?php endif; ?>
				
		<div class = "clearfix"></div>
			
		<h2 class="blog-post-title">
			<a title="Photo Post" href="<?=$url; ?>"><?=$data->name; ?></a>
		</h2>
		<p><?=$data->description; ?></p>

		<a title="Перейти в галерею" class="readMore blog-post-read-more" href="<?=$url; ?>">Перейти в галерею →</a>

	</div>

</article>