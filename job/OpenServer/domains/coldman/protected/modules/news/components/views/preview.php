<?php 
$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_preview',
	'emptyText' => '',
	'template'=> '{items}',
)); ?>