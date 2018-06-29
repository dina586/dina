<?php 
	foreach ($dataProvider as $data)
	{
		echo '<li><a href="'.Yii::app()->createUrl('/'.  strtolower($this->modelName).'/view/view',array('url'=>$data->url)).'">'.$data->name.'</a></li>';
		
	}
?>
