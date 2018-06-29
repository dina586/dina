<?php 
$this->seo('Статьи', 'новый год', 'Новый год');
?>
<div class = "b-about">
<h3 class = "page_title"><span>Статьи</span></h3>
<div class = "l-material">
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
	'template'=>"{items}{pager}",
	'ajaxUpdate'=> FALSE,
	'pager' => array(
    	'header'=>false,
	)
	
)); ?>
</div>
</div>