<?php
	$image = Helper::getCover($data->id, get_class($data), Yii::app()->createUrl('user/admin/view', array("id"=>$data->id)), 'admin', '<img alt = "" src = "/images/noavatar.jpg"/>');
?>

<div class="col-md-3 l-inline_block">
	<div class="panel panel-default">
		<div class="panel-body profile">
			<div class="profile-image">
				<?=$image;?>
			</div>
			<div class="profile-data">
				<div class="profile-data-name">
					<a href = "<?=Yii::app()->createUrl('user/admin/view', array('id'=>$data->id))?>"><?=$data->profile->firstname." ".$data->profile->lastname;?></a>
				</div>
				<!-- <div class="profile-data-title">Singer-Songwriter</div> -->
			</div>
			<div class="profile-controls">
				<a href="<?=Yii::app()->createUrl('user/admin/view', array('id'=>$data->id))?>" class="profile-control-left">
					<span class="fa fa-info"></span>
				</a>
				<a href="tel:+1<?=$data->profile->mobile;?>" class="profile-control-right"><span class="fa fa-phone"></span></a>
			</div>
		</div>
		<div class="panel-body">
			<div class="contact-info">
				<p>
					<small>Mobile</small><br /><?=$data->profile->mobile;?>
				</p>
				<p>
					<small>Email</small><br /><a href = "<?=$data->email;?>"><?=$data->email;?></a>
				</p>
				<p>
					<small>Address</small><br /><?=Helper::viewAddress($data->profile);?>
				</p>
			</div>
		</div>
		<div class="panel-footer">
			<a href = "<?=Yii::app()->createUrl('user/admin/view', array('id'=>$data->id))?>">View</a>
			<a href = "<?=Yii::app()->createUrl('user/admin/update', array('id'=>$data->id))?>">Edit</a>
		</div>
	</div>
</div>
