<?php $url = Yii::app()->createUrl('/shop/product/view', array('url'=>$data->url));
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
	<?php 
	if(isset($data->share_price) && $data->share_price != 0) {
			$cost = $data->share_price;	
			$class = "b-share_price";		
		}
		else {
			$cost = $data->price;
		}
	?>
		<div class = "b-price_wrap j-price_wrap">
			<?php if(isset($data->share_price) && $data->share_price != 0) {?>
			<div class = "b-price <?php echo $class;?>">
				<p><b>Старая цена: </b><span class = "k-price"><?=$data->price?></span></p>
			</div>
			<div class = "b-price">
				<p><b>Цена: </b><span class = "k-share_price"><?=$data->share_price?></span></p>
			</div>
			<?php } else {?>
			<div class = "b-price">
				<p><b>Цена: </b><span class = "k-share_price"><?=$data->price?></span></p>
			</div>
			<?php }?>
		</div>
		<input type = "hidden" name = "k-prod_id" value = "<?=$data->id;?>" />
		<input type = "hidden" name = "k-prod_cost" value = "<?=$cost;?>" />
		<a class = "add_to_cart_button j-add_to_cart" href = "#">купить</a>
</div>