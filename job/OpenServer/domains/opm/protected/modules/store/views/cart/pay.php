<div class = "col-md-12">
	<div class = "b-pay_choose_form col-md-4 l-inline_block">
	
	<img src = "/themes/crm/img/authorizenet.png" alt = "authorize.net"/>
	
	<?php
		$loginID		= Yii::app()->getModule('invoice')->apiLogin;
		$transactionKey = Yii::app()->getModule('invoice')->apiKey;
		$amount 		= $data['total_cost'];
		//$amount 		= 0.01;
		$testMode		= Yii::app()->getModule('invoice')->testMode;		
		// developer accounts: https://test.authorize.net/gateway/transact.dll
		// for real accounts (even in test mode), please make sure that you are
		// posting to: https://secure.authorize.net/gateway/transact.dll
		$url = "https://secure.authorize.net/gateway/transact.dll";
		
		// an invoice is generated using the date and time//
		// a sequence number is randomly generated
		$sequence = rand(1, 1000);
		// a timestamp is generated
		$timeStamp	= time();
		
		$fingerprint = hash_hmac("md5", $loginID . "^" . $sequence . "^" . $timeStamp . "^" . $amount . "^", $transactionKey);
		
	?>
	
	<form method='post' action='<?php echo $url; ?>' >
		<input type='hidden' name='x_login' value='<?php echo $loginID; ?>' />
		<input type='hidden' name='x_amount' value='<?php echo $amount; ?>' />
		<input type='hidden' name='x_description' value='<?=$data['description']?>' />
		
		<input type='hidden' name='x_fp_sequence' value='<?php echo $sequence; ?>' />
		<input type='hidden' name='x_fp_timestamp' value='<?php echo $timeStamp; ?>' />
		<input type='hidden' name='x_fp_hash' value='<?php echo $fingerprint; ?>' />
		<input type='hidden' name='x_test_request' value='<?php echo $testMode; ?>' />
		<input type='hidden' name='x_relay_URL' value='<?=$data['relay_url'];?>' />
		<input type='hidden' name='x_cancel_url' value='<?=$data['cancel_url'];?>' />
		<input type='hidden' name='x_cancel_url_text' value='Cansel and return to site' />
		<input type='hidden' name='x_email' value='<?=$data['email'];?>' />
		<input type='hidden' name='x_email_customer' value='FALSE' />
		<input type='hidden' name='x_show_form' value='PAYMENT_FORM' />
		
		<?php if(key_exists('invoice_num', $data)):?>
			<input type='hidden' name='x_invoice_num' value='<?=$data['invoice_num']?>' />
		<?php endif;?>
		
		<!-- User Information -->
		<input type='hidden' name='x_customer_ip' value='<?=Helper::getRealIp();?>' />
		
		<?php if(key_exists('user_id', $data)):?>
			<input type='hidden' name='x_cust_id' value='<?=$data['user_id']?>' />
		<?php endif;?>
		
		<input type='hidden' name='x_first_name' value='<?=$data['first_name']?>' />
		<input type='hidden' name='x_last_name' value='<?=$data['last_name']?>' />
		<input type='hidden' name='x_zip' value='<?=$data['zip']?>' />
		<input type='hidden' name='x_address' value='<?=$data['address']?>' />
		<input type='hidden' name='x_state' value='<?=$data['state']?>' />
		<input type='hidden' name='x_city' value='<?=$data['city']?>' />
		<input type='hidden' name='x_country' value='<?=$data['country']?>' />
		<input type='hidden' name='x_phone' value='<?=$data['phone']?>' />
			
		<?php 
		$invoiceData = key_exists('invoice_data', $data)?$data['invoice_data']:array();
		$number = 1;
		
		if(!empty($data['invoice_data'])){
			foreach($data['invoice_data'] as $i => $product) {
				$product['name'] = str_replace(array(""), '', $product['name']);
				if(trim($product['name']) == '')
					continue;
				
				$value = $number.'<|>'.$product['name'].'<|><|>'.$product['quantity'].'<|>'.$product['cost'].'<|>N';
				echo '<input type="hidden" name="x_line_item" value="'.$value.'"/>';
				$number++;
		}}
		?>
		
		<?=Fields::submitBtn('PAY WITH CREDIT CART', BsHtml::GLYPHICON_USD);?>
	
	</form>
	</div>
</div>