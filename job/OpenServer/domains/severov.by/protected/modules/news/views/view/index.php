<div class = "l-page_title_wrap">
	<h1 class = "l-page_title">Техники</h1>
</div>
<div class = "clear"></div>
<div class="row">
    <div class="sorting_block image-grid featured_items photo_gallery" id="list">

	<?php $this->widget('bootstrap.widgets.BsListView', array(
		'dataProvider'=>$dataProvider,
		'itemView'=>'_view',
	)); ?>
 
    </div>
	<div class = "clear"></div>
</div>  