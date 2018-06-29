<div class="l-base_wraper">
	
	<div class = "l-page_title_wrap">
		<h1 class = "l-page_title"><?=$this->titles();?></h1>
	</div>
	
	<div class = "g-clear_fix"></div>

	<?php $this->widget('bootstrap.widgets.BsListView', array(
		'dataProvider'=>$dataProvider,
		'itemView'=>'_view',
	)); ?>

	<div class = "g-clear_fix"></div>

</div>

<?php
$this->widget('bootstrap.widgets.BsModal', array(
	'id' => 'j-video_modal',
	'header' => 'Video Preview',
	'content' => '',
	'footer' => array(
		BsHtml::button('Close', array(
			'data-dismiss' => 'modal'
		))
	)
));
?>