<?php $url = Yii::app()->createUrl('/shop/product/view', array('id'=>$data->id));
if(is_file(ROOT_PATH.DIRECTORY_SEPARATOR.'upload'.DIRECTORY_SEPARATOR.'product'.DIRECTORY_SEPARATOR.$data->id.DIRECTORY_SEPARATOR.'thumbnails'.DIRECTORY_SEPARATOR.$data->front_image)){
		$img = '<img src = "/upload/product/'.$data->id.'/thumbnails/'.$data->front_image.'"/>';
	}
	else {
		$img = '<img src = "/images/no-img.png"/>';
	}
?>
<div class="b-main_sliders b-product_preview b-add_to_cart">
	<a class = "slider_img_cont" href = "<?=$url?>">
		<?=$img?>
	</a>
	<br/>
	<a href = "<?=$url?>" class = "slider_link">
		<?php echo $data->name;?>
	</a>
	<section class = "j-product_preview_descr">
		<?php echo $data->description;?>
	</section>
</div>