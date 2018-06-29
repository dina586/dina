<div class="wall_wrap pb50 mb0">
    <div class="sorting_block image-grid featured_items photo_gallery" id="list">
        <?php 
        $this->widget('zii.widgets.CListView', array(
        	'dataProvider'=>$dataProvider,
        	'itemView'=>'_preview',
        	'emptyText' => '',
        	'template'=> '{items}',
        )); ?>
    </div>
</div>