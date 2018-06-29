<h3 class="page_title"><span>Каталог</span> товаров</h3>
<div class = "l-material">
<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
	'template'=>"{items}{pager}",
	'ajaxUpdate'=> FALSE,
	'pager' => array(
    	'header'=>false,
		'prevPageLabel'=>'',
		'nextPageLabel'=>'',
	)
)); ?>
</div>
