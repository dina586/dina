<div class = "g-clear_fix"></div>
<br/>
<br/>

<p><b>Please contact our office at <?=Settings::getVal('phone'); ?> with any questions or concerns.</b></p>


<div class = "g-clear_fix"></div>

<div class = "l-two_blocks">
	<div class = "l-left">
		<div class = "b-footer_signature">
			<?php if($signature->signature != ''){?>
				<img src="data:<?=$signature->signature?>"/>
			<?php } else {?>
				<div class = "l-underline"> </div>
			<?php } ?>
		</div>
		<p>Client Signature</p>
	</div>
	
	<div class = "l-right">
		<div class = "b-footer_date">
			<div class = "l-underline">
				<?=date('m/d/Y');?>
			</div>
		</div>
		<p>Date</p>
	</div>
</div>

<div class = "g-clear_fix"></div>

<div class = "l-two_blocks">
	<div class = "l-left">
		<div class = "l-underline">
			<?=$model->profile->lastname.' '.$model->profile->firstname;?>
		</div>
		<p>Printed Client Name</p>
	</div>
</div>