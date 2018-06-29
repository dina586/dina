<?php 
$this->widget('application.components.BreadCrumb', 
    array('crumbs' => array(
             array('name' => ''.$this->titles().''),
    ) ));
?>
<div class="l-base_wraper">
	
	<h1 class = "l-page_title"><?=$this->titles();?></h1>
	
	<div class = "g-clear_fix"></div>
	
	<div class="comment-box">
	
		<?php $this->widget('bootstrap.widgets.BsListView', array(
			'dataProvider'=>$dataProvider,
			'itemView'=>'_view',
			//'emptyText'=>'<p>Будьте первым кто оставит отзыв!</p>',
		)); ?>

	</div>
	
	<div class = "g-clear_fix"></div>
	
	<?php $this->widget('application.modules.opinion.widgets.OpinionWidget');?>
</div>