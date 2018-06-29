<div class = "l-base_wraper b-catalog">
	<div class = "l-page_title_wrap">
		<h1 class = "l-page_title"><?=$model->name;?></h1>
	</div>
	
		<?php
	$storeHelper = new StoreHelper;
	$this->widget('bootstrap.widgets.BsBreadcrumb', 
		array(
			'links'=>$storeHelper->catalogBreadcrumb($model),
			'encodeLabel'=>false,
			'separator'=>'<span class = "breadcrumb_separator">/</span>',
	));?>
	

	<div class = "a-links_container">
	<?php $this->widget('bootstrap.widgets.BsListView', array(
		'dataProvider'=>$dataProvider,
		'itemView'=>'/product/_view',
	)); ?>
	
	</div>
</div>
