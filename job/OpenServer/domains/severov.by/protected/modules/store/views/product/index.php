<div class = "l-base_wraper">
	
	<h1 class = "l-page_title"><?=$this->pageTitle;?></h1>
	
	<div class = "g-clear_fix"></div>
	<?php $this->widget('zii.widgets.CListView', array(
		'dataProvider'=>$dataProvider,
		'itemView'=>'_view',
		'pager'=> array(
			'htmlOptions'=> array('class'=> 'yiiPager a-links_container')
		)
	)); ?>
</div>