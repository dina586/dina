<div class = "b-doc_header">
	
	<div class = "b-header_row">
		<div class = "b-name_label l-left">Name:</div>
		<div class = "b-name_decoration l-left">
			<div class = "l-underline">
				<?=$model->profile->lastname.' '.$model->profile->firstname;?><br/>
			</div>
		</div>
		<div class = "b-birth_label l-left">Date of Birth:</div>
		<div class = "b-birth_decoration l-left">
			<div class = "l-underline">
				<?=Helper::viewDate($model->profile->birthday);?><br/>
			</div>
		</div>
	</div>
	
	<div class = "b-header_row">
		<div class = "b-address_label l-left">Address:</div>
		<div class = "b-address_decoration l-left">
			<div class = "l-underline">
				<?php
				echo $model->profile->address;
				if($model->profile->apartments)
					echo ', Apt. '.$model->profile->apartments;
				?><br/>
			</div>
		</div>
	</div>
	
	<div class = "b-header_row">
		
		<div class = "b-city_label l-left">City:</div>
		<div class = "b-city_decoration l-left">
			<div class = "l-underline">
				<?php
				if($model->profile->city_id != '' || $model->profile->city_id != 0)
					echo $model->profile->city->city_name_en;
				?><br/>
			</div>
		</div>
		
		<div class = "b-state_label l-left">State:</div>
		<div class = "b-state_decoration l-left">
			<div class = "l-underline">
				<?php
				if($model->profile->state_id != '' || $model->profile->state_id != 0)
					echo $model->profile->state->state_name;
				?><br/>
			</div>
		</div>
		
		<div class = "b-zip_label l-left">Zip:</div>
		<div class = "b-zip_decoration l-left">
			<div class = "l-underline">
				<?=$model->profile->zip;?><br/>
			</div>
		</div>
		
	</div>
	
	<div class = "b-header_row">
		
		<div class = "b-phone_label l-left">Phone:</div>
		<div class = "b-phone_decoration l-left">
			<div class = "l-underline">
				<?=$model->profile->mobile;?><br/>
			</div>
		</div>
		
		<div class = "b-emergency_label l-left">Emergency Contact Phone:</div>
		<div class = "b-emergency_decoration l-left">
			<div class = "l-underline">
				<?=$model->profile->emergency_phone;?><br/>
			</div>
		</div>
				
	</div>
	
	<div class = "b-header_row">
		
		<div class = "b-email_label l-left">Email:</div>
		<div class = "b-email_decoration l-left">
			<div class = "l-underline">
				<?=$model->email;?><br/>
			</div>
		</div>
		
		<div class = "b-referred_label l-left">Referred By:</div>
		<div class = "b-referred_decoration l-left">
			<div class = "l-underline">
				<?php 
				if(isset(Yii::app()->getModule('user')->hear[$model->profile->here_about]))
					echo Yii::app()->getModule('user')->hear[$model->profile->here_about];
				if($model->profile->friend_name != '')
					echo ', '.$model->profile->friend_name;
				?><br/>
			</div>
		</div>
				
	</div>
	
</div>