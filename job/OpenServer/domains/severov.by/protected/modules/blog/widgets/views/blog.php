<?php 
$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_blog',
	'emptyText' => '',
	'template'=> '{items}',
)); ?>