<div class="b-catalog">
	<a href = "<?=Yii::app()->createUrl('/shop/catalog/view', array('id'=>$data->id));?>"><?php echo $data->name ?></a>
	<br/>
	<br/>
<?php
$i = 0;
foreach($data->product as $product) {
	if($i == 4) {
		break;
	}
	$i++;
	$url = Yii::app()->createUrl('/shop/product/view', array('id'=>$product->id));
	
	if(is_file(ROOT_PATH.DIRECTORY_SEPARATOR.'upload'.DIRECTORY_SEPARATOR.'product'.DIRECTORY_SEPARATOR.$product->id.DIRECTORY_SEPARATOR.'thumbnails'.DIRECTORY_SEPARATOR.$product->front_image)){
		$img = '<img src = "/upload/product/'.$product->id.'/thumbnails/'.$product->front_image.'"/>';
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
			<?php echo $product->name;?>
		</a>
		<section class = "j-product_preview_descr">
			<?php echo $product->description;?>
		</section>
		<?php 
		if(isset($product->share_price) && $product->share_price != 0) {
				$cost = $product->share_price;	
				$class = "b-share_price";		
			}
			else {
				$cost = $product->price;
			}
		?>
		<div class = "b-price_wrap j-price_wrap">
			<?php if(isset($product->share_price) && $product->share_price != 0) {?>
			<div class = "b-price <?php echo $class;?>">
				<p><b>Старая цена: </b><span class = "k-price"><?=$product->price?></span></p>
			</div>
			<div class = "b-price">
				<p><b>Цена: </b><span class = "k-share_price"><?=$product->share_price?></span></p>
			</div>
			<?php } else {?>
			<div class = "b-price">
				<p><b>Цена: </b><span class = "k-share_price"><?=$product->price?></span></p>
			</div>
			<?php }?>
		</div>
			<input type = "hidden" name = "k-prod_id" value = "<?=$product->id;?>" />
			<input type = "hidden" name = "k-prod_cost" value = "<?=$cost;?>" />
			<a class = "add_to_cart_button j-add_to_cart" href = "#">купить</a>
	</div>
<?php }?>
</div>
