<?php foreach ($dataProvider as $data): 
	$this->renderPartial('_view', array('data'=>$data));
endforeach ?>

<?php
$this->widget('bootstrap.widgets.BsPager', array(
	'pages' => $pages,
))
?>