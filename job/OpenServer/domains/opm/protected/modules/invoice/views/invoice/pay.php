<div class = "col-md-12">
	<div class = "b-pay_choose_form col-md-3 l-inline_block">
	
	<img src = "/themes/crm/img/authorizenet.png" alt = "authorize.net"/>
	
	<?php
		$loginID		= Yii::app()->getModule('invoice')->apiLogin;
		$transactionKey = Yii::app()->getModule('invoice')->apiKey;
		$amount 		= $model->total_cost;
		//$amount 		= 0.01;
		$testMode		= Yii::app()->getModule('invoice')->testMode;
		
		$description = InvoiceHelper::invoiceName($model);
		
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
		
		$address = '';
		if($user->profile->address != '')
			$address  .= $user->profile->address.', ';
		
		if($user->profile->apartments != '')
			$address .= 'Apt. '.$user->profile->apartments;
		$address = trim ($address, ', ');
	?>
	
	<form method='post' action='<?php echo $url; ?>' >
		<input type='hidden' name='x_login' value='<?php echo $loginID; ?>' />
		<input type='hidden' name='x_amount' value='<?php echo $amount; ?>' />
		<input type='hidden' name='x_description' value='<?php echo $description; ?>' />
		<input type='hidden' name='x_invoice_num' value='<?=$model->id;?>' />
		<input type='hidden' name='x_fp_sequence' value='<?php echo $sequence; ?>' />
		<input type='hidden' name='x_fp_timestamp' value='<?php echo $timeStamp; ?>' />
		<input type='hidden' name='x_fp_hash' value='<?php echo $fingerprint; ?>' />
		<input type='hidden' name='x_test_request' value='<?php echo $testMode; ?>' />
		<input type='hidden' name='x_relay_URL' value='<?=Yii::app()->createAbsoluteUrl('invoice/invoice/confirm')?>' />
		<input type='hidden' name='x_cancel_url' value='<?=Yii::app()->createAbsoluteUrl('invoice/invoice/cansel')?>' />
		<input type='hidden' name='x_cancel_url_text' value='Cansel and return to site' />
		<input type='hidden' name='x_email' value='<?=$model->email;?>' />
		<input type='hidden' name='x_email_customer' value='FALSE' />
		<input type='hidden' name='x_show_form' value='PAYMENT_FORM' />
		
		<!-- User Information -->
		<input type='hidden' name='x_customer_ip' value='<?=Helper::getRealIp();?>' />
		<input type='hidden' name='x_cust_id' value='<?=$user->id;?>' />
		<input type='hidden' name='x_first_name' value='<?=$user->profile->firstname;?>' />
		<input type='hidden' name='x_last_name' value='<?=$user->profile->lastname;?>' />
		<input type='hidden' name='x_zip' value='<?=$user->profile->zip;?>' />
		<input type='hidden' name='x_address' value='<?=$address;?>' />
		<input type='hidden' name='x_state' value='<?=$user->profile->state_id==''?'':$user->profile->state->state_abbreviation;?>' />
		<input type='hidden' name='x_city' value='<?=$user->profile->city_id==''?'':$user->profile->city->city_name_en;?>' />
		<input type='hidden' name='x_country' value='<?=$user->profile->country_id==''?'':$user->profile->country->country_name_en;?>' />
		<input type='hidden' name='x_phone' value='<?=$user->profile->mobile;?>' />
		
		<?php 
		$invoiceData = unserialize($model->invoice_data);
		$number = 1;
		if(!empty($invoiceData)){
			foreach($invoiceData as $i => $v) {
				if(trim($invoiceData[$i][1]) == '')
					continue;

				$value = $number.'<|> Eyebrows - Procedure 3 - Re-touch<|><|>'.$invoiceData[$i][2].'<|>'.$invoiceData[$i][3].'<|>N';
				//echo '<input type="hidden" name="x_line_item" value="'.$value.'"/>';
				$number++;
		}}
		?>
		
		<?=Fields::submitBtn('PAY WITH CREDIT CART', BsHtml::GLYPHICON_USD);?>
	
	</form>
	</div>
</div>