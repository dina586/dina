<?php 
$this->widget('application.components.BreadCrumb', 
    array('crumbs' => array(
             array('name' => ''.$this->titles().''),
    ) ));
?>
<div class="page_title_block b-blog-title">
    <div class="bg_title">
        <h1><?=$this->titles();?></h1>
    </div>
</div>
<div class = "clear"></div>
<p><?=$content->content;?></p>
<div class = "clear"></div>
<div class="content_block row no-sidebar">
    <div class="fl-container">
        <div class="posts-block">
            <div class="contentarea">
			    <div class="row pb50" data-anim-type="fadeInUp" data-anim-delay="300">
                    <div class="sorting_block image-grid featured_items photo_gallery column1" id="list">
                
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
<div class="clear"></div>