<?php 
$this->widget('application.components.BreadCrumb', 
    array('crumbs' => array(
             array('name' => 'Техники'),
    ) ));
?>
<div class = "l-page_title_wrap">
	<h1 class = "l-page_title">Техники</h1>
</div>
<div class = "clear"></div>
<p><?=$content->content;?></p>
<div class = "clear"></div>

<div class="content_block row no-sidebar">
    <div class="fl-container">
        <div class="posts-block">
			<div class="contentarea">
				<div class="row pb50" data-anim-type="fadeInUp" data-anim-delay="300">
					<div class="sorting_block image-grid featured_items photo_gallery" id="list">
    
						<?php $this->widget('bootstrap.widgets.BsListView', array(
							'dataProvider'=>$dataProvider,
							'itemView'=>'_view',
						)); ?>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>
	<div class = "clear"></div>
