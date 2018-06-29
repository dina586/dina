<div class="l-base_wraper">
	
	<div class = "l-page_title_wrap">
		<h1 class = "l-page_title"><?=$this->titles();?></h1>
	</div>
	<article class = "col-md-12 g-styles">
	<?php $this->widget('application.modules.block.components.GetBlocks', array('view'=>'service_block'));?>
	</article>
	<div class = "g-clear_fix"></div>

	<?php $this->widget('bootstrap.widgets.BsListView', array(
		'dataProvider'=>$dataProvider,
		'itemView'=>'_view',
	)); ?>

	<div class = "g-clear_fix"></div>

</div>