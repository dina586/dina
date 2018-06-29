<div class = "l-base_wraper b-catalog">
	<div class = "l-page_title_wrap">
		<h1 class = "l-page_title"><?=$this->pageTitle?></h1>
	</div>

	<div class = "a-links_container">
		<?php $this->widget('bootstrap.widgets.BsListView', array(
			'dataProvider'=>$dataProvider,
			'itemView'=>'/product/_view',
		)); ?>
	
	</div>
</div>
