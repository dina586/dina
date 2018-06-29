<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'order_code',
		array(
			'name'=>'total_cost',
			'value'=>number_format($model->total_cost, 0, "", " "),
			'htmlOptions'=>array('class'=>'l-nowrap'),
		),
		'email',
		array(
			'name'=>'user_id',
			'type'=>'raw',
			'value'=>$model->user_id==0?'':Helper::userLink($model->user_id),	
		),
		'date',
		array(
			'name'=>'status',
			'value'=>Yii::app()->getModule("store")->orderStatus[$model->status],
		),
	),
)); ?>
	
<h2 class = "b-history_title"><?=Yii::t('shop', 'Customer information');?></h2>

<?php 
$orderData = unserialize($model->order_data);
$arr = array();

if(count($orderData)>0) {
	foreach($orderData as $k => $v) {
		$arr[] = array(
			'name'=>$k,
			'value'=>$v,		
		);
	}
}	

$attributes = array_merge(
	$arr, 
	array(
		array('name'=>'user_comment', 'value'=>$model->user_comment, 'type'=>'raw'),
		'user_ip', 
		'user_agent',
	)
);

$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>$attributes
)); ?>

<h2 class = "b-history_title"><?=Yii::t('shop', 'Payment Information');?></h2>

<p class = "l-hint"><?=Yii::t('shop', 'Payment information is available only if payment systems connect ot site');?></p>

<br/>
<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(	
		array(
			'name'=>'is_paid',
			'value'=>Yii::app()->getModule('store')->orderIsPaid[$model->is_paid],
		),
		array(
			'name'=>'payment_system',
			'value'=>Yii::app()->getModule('store')->orderPayment[$model->payment_system],
		),
	),
)); ?>

<h2 class = "b-history_title"><?=Yii::t('shop', 'Purchase Information');?></h2>

<?php 
$productData = unserialize($model->prod_data);
if(count($productData)>0) {
	foreach($productData as $product) { 
		
		$data = Product::model()->findByPk($product['id']);
		if($data === null) {
			$name = '<p class = "store_history_product_title">'.$product['name'].' ('.Yii::t('shop', 'this product has been removed').')</p>';
			$image = Helper::getCover($product['id'], 'Product', '', 'admin');
		}
		else {
			$name = '<a href = "'.Yii::app()->createUrl('store/product/view', array('url'=>$data->url)).'" class = "store_history_product_title l-inline_block">'.$product['name'].'</a>';
			$image = Helper::getCover($product['id'], 'Product', Yii::app()->createUrl('store/product/view', array('url'=>$data->url)), 'admin');
		}
		?>
		<div class = "b-store_history_product">
			<div class = "b-store_history_image l-inline_block">
				<?=$image;?>
			</div>
			<div class = "b-store_history_description l-inline_block">
				<?=$name?>
				<p><b><?=Yii::t('shop', 'Price per unit')?></b>: <?=number_format($product['cost'], 0, "", " ");?></p>
				<p><b><?=Yii::t('shop', 'Quantity')?></b>: <?=$product['quantity'];?></p>
			</div>
		</div>
<?php }}?>
	
	


