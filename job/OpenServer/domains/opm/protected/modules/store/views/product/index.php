<div class = "l-base_wraper">
	
	<h1 class = "l-page_title"><?=$this->pageTitle;?></h1>
	
	<div class = "g-clear_fix"></div>
	<?php $this->widget('bootstrap.widgets.BsListView', array(
		'dataProvider'=>$dataProvider,
		'itemView'=>'_view',

	)); ?>
</div>