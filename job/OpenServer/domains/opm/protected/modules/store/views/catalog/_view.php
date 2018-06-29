<section class = "b-catalog j-catalog">
<a class = "prod_cat_title" href = "<?=Yii::app()->createUrl('shop/catalog/view', array('url'=>$data->url));?>"><?=$data->name;?></a>
<div class = "g-clear_fix"></div>
<?php 
$i = 0;
foreach($data->product as $product) {
	
	if($i == Yii::app()->controller->module->productPerRow) {
		break;
		$class = "r-prod_last";
		$i = 0;
	} 
	$this->renderPartial('/product/_view', array('data'=>$product, 'clast'=>$class));
	$i++;
}
?>
</section>
<div class = "g-clear_fix"></div>