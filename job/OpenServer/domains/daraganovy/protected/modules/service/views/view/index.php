<?php 
/*$this->widget('application.components.BreadCrumb', 
    array('crumbs' => array(
             array('name' => ''.$this->titles().''),
    ) ));
*/?>
<div class="g-content">
<div class="l-base_wraper">
	
	<div class = "l-page_title_wrap">
		<h1 class = "l-page_title"><?=$this->titles();?></h1>
	</div>

<div class = "clear"></div>

                
                        <?php $this->widget('bootstrap.widgets.BsListView', array(
                            'dataProvider'=>$dataProvider,
                            'itemView'=>'_view',
                        )); ?>
                
                    
<div class="clear"></div>
</div>
</div>