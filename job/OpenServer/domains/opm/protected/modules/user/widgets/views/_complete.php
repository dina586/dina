<div class="timeline-item timeline-item-right">
	
	<div class="timeline-item-info">
		<?=$data->visit_date?>
	</div>
	
	<div class="timeline-item-icon">
		<span class="fa fa-info-circle"></span>
	</div>                                   
	
	<div class="timeline-item-content">
		<div class="timeline-heading">
			<?=$this->avatar;?> <b><?=$data->service->name;?></b> - <?=$data->procedure->name;?>
		</div>                                        
		<div class="timeline-body">
			<?=$data->comment?>
			<?php $this->widget('file_uploader.ImageRenderWidget', array('id'=>$data->id, 'modelName'=>get_class($data), 'type'=>'thumbnail', 'description'=>true));?>
		</div>
		<div class = "timeline-footer">
			<a href = "<?=Yii::app()->createUrl('user/procedure/update', array('id'=>$data->id))?>">
				<span class="fa fa-edit"></span>
				Edit
			</a>
			<div class = "pull-right">
				<?php 
					$invoice = Invoice::getInvoice(2, $data->id);
					if($invoice !== null):
				?>
					<?php if($invoice->status == 0){
						$invIcon = 'fa-money';
					?>
						<a target = "_blank" href = "<?=Yii::app()->createUrl('invoice/invoice/pay', array('id'=>$invoice->id))?>">
							<span class="fa fa-usd"></span>
							Pay
						</a>
						
					<?php } else
						$invIcon = 'fa-thumbs-o-up';
					?>
										
					<a target = "_blank" href = "<?=Yii::app()->createUrl('invoice/view/view', array('id'=>$invoice->id))?>">
						<span class="fa <?=$invIcon;?>"></span>
						Print Invoice
					</a>
				<?php endif;?>
				
				<?php if($data->service->contract != 0):?>
				<a target = "_blank" href = "<?=Yii::app()->createUrl('service/view/contract', array("user_id"=>$data->user_id, "service_id"=>$data->service_id, 'signature_id'=>$data->id))?>">
					<span class="fa fa-print"></span>
					Print Contract
				</a>
				
				<?php 
				if($data->signature == ''){?>
					<a target = "_blank" href = "<?=Yii::app()->createUrl('user/procedure/signature', array("id"=>$data->id))?>">
						<span class="fa fa-edit"></span>
						Write Contract
					</a>
				<?php } else {?>
					<a target = "_blank" href = "<?=Yii::app()->createUrl('user/procedure/signature', array("id"=>$data->id))?>">
						<span class="fa fa-check"></span>
					</a>
				<?php } ?>
				<?php endif;?>
			</div>
		</div>
	</div>
</div>       
