<div class="l-base_wraper">
	
	<div class = "l-page_title_wrap">
		<h1 class = "l-page_title"><?php echo "<?=\$this->pageTitle;?>";?></h1>
	</div>
	
	<div class = "g-clear_fix"></div>

<?php echo "<?php"; ?> $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>

</div>