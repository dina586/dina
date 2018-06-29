<div class = "b-latest_news">
	<a href = "<?=Yii::app()->createUrl('news/view/view', array('url'=>$data->url));?>"><?=$data->name;?></a>
	<p><?=cText::wordTrim($data->description, 20, '...');?></p>
</div>