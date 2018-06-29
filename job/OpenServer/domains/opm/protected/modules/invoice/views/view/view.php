<?php 
$total = $model->total_cost - $model->deposit;
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
			<p>12113 Santa Monica, Suite 203,</p>
			<p>Los Angeles, CA 90025</p>
			<br/><br/>
			<p><?=trim(Settings::getVal('phone'), '+1 '); ?></p>
			<p>opmakeup@gmail.com</p>
					
		</div>
		<div class = "g-invoice_number">
			<h3>INVOICE <?=$model->id;?></h3>
		</div>
		
	</div>
	
	<div class = "g-clear_fix"></div>
	
	<div class = "b-payment">
		
		<div class = "b-payment_user">
			<h4>BILL TO</h4>
			<p><?=$model->name;?></p>
			<p><?=$model->address;?></p>
			<p><?=$model->phone;?></p>
			<p><?=$model->email;?></p>
		</div>
		
		<div class = "b-payment_date">
			<?php if($model->status != 1):?>
				<?php if(Helper::viewDate(strtotime($model->due_date))!=''){?>
				<section class = "r-payment_date_last">
					<p>DUE DATE<br/>
						<?=Helper::viewDate(strtotime($model->due_date));?>
					</p>
				</section>
				<?php }?>
				
				
				<section class = "b-payment_need">
					<p>PLEASE PAY<br/>
					$ <?=Helper::viewPrice($total)?>
					</p>
				</section>
			<?php else: ?>
				<section class = "r-payment_date_last b-payment_paid">
					<img src = "/images/invoice_paid.png"/>
				</section>
			<?php endif;?>
			
			<section>
				<p>DATE<br/>
				<?=Helper::viewDate(strtotime($model->create_date));?>
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
			</tr>
		</thead>
		<tbody>
			
	<?php 
		$i = 0;
		$subtotal = 0;
		$invoiceData = unserialize($model->invoice_data);
		
		if(!empty($invoiceData)){
			foreach($invoiceData as $i => $v) {
				if(trim($invoiceData[$i][1]) == '')
					continue;
				if($i%2==0)
					$class = "invoice_background";
				else $class = '';
				$subtotal += $invoiceData[$i][2] * $invoiceData[$i][3];
				?>
				<tr <?=$class?>>
					<td class = "invoice_product_name"><b><?=$invoiceData[$i][1];?></b></td>
					<td><?=$invoiceData[$i][2];?></td>
					<td class = "l-no-wrap">$ <?=Helper::viewPrice($invoiceData[$i][3]);?></td>
					<td class = "l-no-wrap">$ <?=Helper::viewPrice($invoiceData[$i][4]);?></td>
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
			<section class = "l-align_right"><?=Helper::viewPrice($subtotal);?></section>
		</div>
		
		<?php 
			if($model->discount > 0 ):
		?>
		<div class = "b-invoice_total_row">
			<section class = "l-align_left">DISCOUNT:</section> 
			<section class = "l-align_right"><?=Helper::viewPrice($model->discount)?></section>
		</div>
		<?php endif;?>
		
		<div class = "b-invoice_total_row">
			<section class = "l-align_left">TAX (<?=$model->tax_percent;?>%):</section> 
			<section class = "l-align_right"><?=Helper::viewPrice($model->tax)?></section>
		</div>
		
		<div class = "b-invoice_total_row">
			<section class = "l-align_left">SHIPPING:</section> 
			<section class = "l-align_right"><?=Helper::viewPrice($model->shipping)?></section>
		</div>
		
		<?php 
			if($model->deposit > 0 ):
		?>
		<div class = "b-invoice_total_row">
			<section class = "l-align_left">DEPOSIT:</section> 
			<section class = "l-align_right"><?=Helper::viewPrice($model->deposit)?></section>
		</div>
		<?php endif; ?>
		
		<?php 
			if($model->deposit > 0 &&  $model->status != 1):
		?>
		<div class = "b-invoice_total_row">
			<section class = "l-align_left">PAYMENT:</section> 
			<section class = "l-align_right"><?=InvoiceHelper::getPayment($subtotal, $model);?></section>
		</div>
		<?php endif; ?>
		
		<?php 
			if($model->status == 1 ):
		?>
			<div class = "b-invoice_total_row">
				<section class = "l-align_left">PAYMENT:</section> 
				<section class = "l-align_right"><?=Helper::viewPrice($model->total_cost)?></section>
			</div>
		
			<div class = "b-invoice_total_row b-total_due">
				<section class = "l-align_left">TOTAL:</section> 
				<section class = "l-align_right">$ 0</section>
			</div>
		
		<?php else :?>
			<div class = "b-invoice_total_row b-total_due">
				<section class = "l-align_left">TOTAL DUE:</section> 
				<section class = "l-align_right">$ <?=Helper::viewPrice($model->total_cost)?></section>
			</div>
		
		<?php endif;?>
		
		<div class = "b-invoice_total_row b-total_thanks">
			<section class = "thank_you">THANK YOU.</section>
		</div>

	</div>
</div>
</body>
</html>