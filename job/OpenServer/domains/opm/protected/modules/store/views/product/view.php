<?php
$model->price = StoreHelper::viewPrice($model->price);
$model->share_price = StoreHelper::viewPrice($model->share_price);
	
/*if($model->share_price != '' && $model->share_price != 0) {
	$cost =	'$ <span class = "j-product_price b-product_current_price">'.$model->share_price.'</span> <br />
	$ <span class = "b-product_old_price">'.$model->price.'</span> ';
}
else {*/
	$cost = '<span>$ <span class = "j-item_price">'.StoreHelper::viewPrice($model->price).'</span></span';
//}

$image = Helper::getCover($model->id, get_class($model), '', 'medium');

if($model->status == 0) {
	$status = '<section class="b-product_status"><p>Нет в наличии</p></section>';
}
else $status = '';

$storeHelper = new StoreHelper;
?>

<div class = "l-base_wraper b-product">
	
		<div class = "l-page_title_wrap">
			<h1 class = "l-page_title"><?=$model->name;?></h1>
		</div>
		<div class = "g-clear_fix"></div>
		<?php $this->widget('bootstrap.widgets.BsBreadcrumb', 
				array(
					'links'=>$storeHelper->breadcrumb($model->catalog, $model->name),
					'encodeLabel'=>false,
					'separator'=>'<span class = "breadcrumb_separator">/</span>',
		));?>
		<div class = "g-clear_fix"></div>

		<div class = "b-product_images">
			<div class = "j-item_image">
				<?=$image;?>
			</div>
			<div class = "b-product_images_thumbnails">
				<?php 
					$this->widget('file_uploader.ImageRenderWidget', array('id'=>$model->id, 'modelName'=>get_class($model), 'type'=>'admin'));
				?>
			</div>
		</div>

		<div class = "b-product_description">
			
			<div class = "b-product_cost">
				
				<section class="b-product_price l-inline_block">
					<p>Cost: <?=$cost;?></p>
				</section>
				
				<a class = "a-add_to_cart l-store_button l-inline_block" href = "<?=Yii::app()->createUrl('store/cart/addToCart',array('id'=>$model->id));?>"><?=Yii::t('shop', 'add to cart')?></a>
			</div>
			
			<div class = "g-clear_fix"></div>
			
			<article class = "g-styles">
				<?=$model->content;?>
			</article>
			
			
		</div>
		<?php 
			$this->widget('file_uploader.FileRenderWidget', array('id'=>$model->id, 'modelName'=>get_class($model)));
		?>
	</div>

	<div class = "g-clear_fix"></div>
		
<?=Helper::editLink(Yii::app()->createUrl(Yii::app()->controller->module->id.'/'.Yii::app()->controller->id.'/update', array('id'=>$model->id)));?>	


