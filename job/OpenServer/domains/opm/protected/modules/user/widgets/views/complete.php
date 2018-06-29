<?php 
if($dataProvider->getItemCount()>0):
?>
	<div class = "b-profile_timezone">
		
		<div class="timeline timeline-right">
			
			<div class="timeline-item timeline-main">
				<div class="timeline-date"><?=$this->status == 'complete'?'Complete':'TO VISIT'?></div>
			</div>
			
			<?php 
				$this->widget('bootstrap.widgets.BsListView', array(
					'dataProvider'=>$dataProvider,
					'itemView'=>'_complete',
					'emptyText'=>'',
					'template'=>'{items}{pager}',
					'ajaxUpdate'=> true,
				)); 
			?>
				
			<div class="timeline-item timeline-main timeline-end">
				<div class="timeline-date">
					<span class="fa fa-globe"></span>
				</div>
			</div>
		</div>
	</div>
<?php endif;?>