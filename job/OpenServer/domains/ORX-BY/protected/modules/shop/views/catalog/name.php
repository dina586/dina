<h3 class = "page_title"><?php echo $catalog ?></h3>

<div class = "l-material">
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'/product/_view',
	'template'=>"{items}{pager}",
	'ajaxUpdate'=> FALSE,
	'pager' => array(
    	'header'=>false,
		'prevPageLabel'=>'',
		'nextPageLabel'=>'',
	)
)); ?>
</div>