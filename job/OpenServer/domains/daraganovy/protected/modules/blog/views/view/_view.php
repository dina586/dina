

<!--<div class = "l-item b-<?//=Yii::app()->controller->module->id;?>_preview">
	
	<a class = "l-item_image" href = "<?//=Yii::app()->createUrl(Yii::app()->controller->module->id.'/view/view', array('url'=>$data->url));?>"><?//=$img;?></a>
	
	<time datetime="<?//=Yii::app()->dateFormatter->format("yyyy-MM-dd", $data->create_date);?>">
		<?//=Yii::app()->dateFormatter->format(Yii::app()->locale->getDateFormat(), $data->create_date);?>
	</time>
	
	<a class = "l-item_title" href = "<?//=Yii::app()->createUrl(Yii::app()->controller->module->id.'/view/view', array('url'=>$data->url));?>"><?//=$data->name;?></a>
	
	<p><?//=$data->description;?></p>

</div>-->
<?php 
	$path = Yii::getPathOfAlias('webroot').DS."upload".DS."blog".DS.$data->id.".jpg";
	if(file_exists($path))
		$src = '<img src = "/upload/blog/'.$data->id.'.jpg" title = "'.$data->name.'" alt = "'.$data->name.'" />';
	else
		$src = '';
	
	$url = Helper::seoLink($data->id, get_class($data));
	$name = $data->name;
	$content = $data->content;
?>
<section class="content-section clearfix">

			<!-- Start Content Left -->
    <div class="content-inner-left">

					<!-- Start Post -->
		<article class="blog-post sticky">
			<div class="blog-post-content">
				<div class="blog-post-featured-media">
					<div class="thumb">
						<a href="<?=$url;?>" title="<?=$name;?>" data-caption="Read More">			
							<?=$src;?>
						</a>
					</div>
				</div>
				<h2 class="blog-post-title">
					<a href="<?=$url;?>" title="<?=$name;?>"><?=$name;?></a>
				</h2>
				<p><?=$content;?></p>
				<a href="<?=$url;?>" class="readMore blog-post-read-more" title="Read more">Читать далее &rarr;</a>
			</div>
		</article>          
    </div>
</section>
