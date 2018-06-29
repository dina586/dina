<?php
$content = Content::model()->findByPk(1);
if($content->seo_title == '')
	$seoTitle = $content->name;
else 
	$seoTitle = $content->seo_title;
$this->seo($seoTitle, $content->seo_keywords, $content->seo_description);
?>
<div class = "b-about">
	<h3 class = "page_title"><?php echo $content->name;?></h3>
	<div class = "l-material">
		<article>
		<?php 
			echo $content->description;
		?>
		<div class = "g-clear_fix"></div>
		
		</article>
		
	</div>
</div>
