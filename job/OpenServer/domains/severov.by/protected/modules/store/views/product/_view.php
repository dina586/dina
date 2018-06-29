<?php 
$class = $index%Yii::app()->getModule('store')->productPerRow ? '' : ' r-store_preview';

$url = Yii::app()->createUrl('store/product/view', array('url'=>$data->url));

$image = Helper::getCover($data->id, get_class($data), Yii::app()->createUrl('store/product/view', array("url"=>$data->url)));

$data->price = StoreHelper::viewPrice($data->price);
$data->share_price = StoreHelper::viewPrice($data->share_price);
	
/*if($data->share_price != '' && $data->share_price != 0) {
	$cost =	'<span class = "b-store_preview_current_price j-item_price">'.$data->share_price.'</span><br />
	<span class = "b-store_preview_old_price">'.$data->price.'</span> ';
}
else {*/
	$cost = '<span class = "b-store_preview_current_price j-item_price">'.$data->price.'</span> ';
//}

if(isset($jClass)) 
	$jClass = ' j-item_preview';
else 
	$jClass = '';
?>

<div class = "b-store_preview l-inline_block<?=$jClass;?><?=$class;?> j-item_height_container">
	<section class = "b-store_preview_img j-item_image j-item_height">
		<?=$image?>
	</section>
	<section class = "b-store_preview_title j-item_height">
		<a href = "<?=$url?>"><?=$data->name;?></a>
	</section>
	<section class = "b-store_preview_descrp j-item_height">
		<p><?=$data->description;?></p>
	</section>
	<section class = "b-store_preview_cost k-item_cost j-item_height">
		<?=$cost;?>
	</section>
	<section class = "b-store_preview_cart">
		<a class = "a-add_to_cart l-store_button" href = "<?=Yii::app()->createUrl('store/cart/addToCart',array('id'=>$data->id));?>"><?=Yii::t('shop', 'add to cart')?></a>
	</section>
</div>
