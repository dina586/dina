<?php 
$orderData = unserialize($model->order_data);
	$tax = $model->total_cost * $model->invoice->tax/100;
	$shipping = $orderData['International Shipping'] !='' ?$orderData['International Shipping']:$orderData['US Shipping'];
	$total = $model->total_cost+$tax-$model->invoice->payment+$shipping;
	if($total<0)
		$total = 0;
?>
<!DOCTYPE html>
<html lang="<?=Yii::app()->language;?>">
<head>
	<meta charset="utf-8" />
	<?php 
		$cs=Yii::app()->clientScript;
	
		$cs->registerCssFile(Yii::app()->baseUrl . '/css/store_invoice.css');
		?>
</head>

<body>
<div class = "g-container">
	
	<div class = "g-header">
		<div class = "g-logo">
			<img src = "/images/logo_document.png" alt = ""/>
		</div>
		<div class = "g-header_block">
			<br/>
			<p>651 N Sepulveda Blvd 2B</p>
			<p>Los Angeles, CA 90049-2185</p>
			<br/><br/>
			<p>(310) 471-7777</p>
			<p>opmakeup@gmail.com</p>
			
		</div>
	</div>
	
	<div class = "g-clear_fix"></div>
	
	<div class = "b-payment">
		
		<div class = "b-payment_user">
			<h4>BILL TO</h4>
			<p><?=$user['name']?></p>
			<p><?=$user['address'];?></p>
		</div>
		
		<div class = "b-payment_date">
			<section>
				<p>DATE<br/>
				<?=Helper::viewDate(strtotime($model->date));?>
				</p>
			</section>
			<section class = "b-payment_need">
				<p>PLEASE PAY<br/>
				$ <?=Helper::viewPrice($total)?>
				</p>
			</section>
			<section class = "r-payment_date_last">
				<p>DUE DATE<br/>
					<?=$model->invoice->due_date;?>
				</p>
			</section>
		</div>
	</div>
	
	<div class = "g-clear_fix"></div>
	<table class = "b-invoice_products">
		<thead>
			<tr class = "invoice_background">
				<td class = "invoice_product_name">ACTIVITY</td>
				<td>QTY</td>
				<td>PRICE</td>
				<td>AMOUNT</td>
				<td></td>
			</tr>
		</thead>
		<tbody>
			
	<?php 
		$i = 0;
		$productData = unserialize($model->prod_data);
		
		if(count($productData)>0) {
			foreach($productData as $product) { 
				if($i%2==0)
					$class = "invoice_background";
				else $class = '';
				?>
				<tr <?=$class?>>
					<td class = "invoice_product_name"><b><?=$product['name']?></b></td>
					<td><?=BsHtml::textField('', $product['quantity']);?></td>
					<td class = "l-no-wrap"><?=BsHtml::textField('', $product['cost']);?></td>
					<td class = "l-no-wrap">$ <?=$product['cost']*$product['quantity']?></td>
					<td>+ - </td>
				</tr>
		<?php }}?>
		</tbody>
	</table>	
	<div class = "g-clear_fix"></div>
	
	<div class = "b-invoice_info">
		<p>
		"PLEASE READ THE BELOW STATEMENT CAREFULLY."<br/>
		ALL OPM PRODUCT SALES ARE FINAL AND NON-REFUNDABLE. OPM will<br/>
		not refund any OPM purchases. However should any OPM product be deemed<br/>
		defective, OPM will exchange the product at no cost to the buyer. The buyer is<br/>
		responsible for all shipping cost.<br/>
		Please call for Questions or Concerns. 310-471-7777
		</p>
	</div>
	
	<div class = "b-invoice_total">
		<div class = "b-invoice_total_row">
			<section class = "l-align_left">SUBTOTAL:</section> 
			<section class = "l-align_right"><?=Helper::viewPrice($model->total_cost)?></section>
		</div>
		
		
		
		<div class = "b-invoice_total_row">
			<section class = "l-align_left">TAX(<?=$model->invoice->tax;?>)%:</section> 
			
			<section class = "l-align_right"><?=Helper::viewPrice($tax)?></section>
		</div>
		
		<div class = "b-invoice_total_row">
			<section class = "l-align_left">Shipping:</section> 
			<section class = "l-align_right"><?=Helper::viewPrice($shipping);?></section>
		</div>
		
		<div class = "b-invoice_total_row">
			<section class = "l-align_left">PAYMENT:</section> 
			<section class = "l-align_right"><?=Helper::viewPrice($model->invoice->payment)?></section>
		</div>
		
		<div class = "b-invoice_total_row b-total_due">
			<section class = "l-align_left">TOTAL DUE:</section> 
			<section class = "l-align_right">$ <?=Helper::viewPrice($total)?></section>
		</div>
		
		<div class = "b-invoice_total_row b-total_thanks">
			<section class = "thank_you">THANK YOU.</section>
		</div>

	</div>
</div>
</body>
</html>