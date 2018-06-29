<?php $this->seo('Индексация'); ?>
<h1 class = "l-page_title"><?=$this->pageTitle;?></h1>
<br/>
<?php
echo CHtml::ajaxLink(
	'Переиндексировать сайт', 
	Yii::app()->createUrl('search/view/create'),
	array(
		'beforeSend'=>'js:function(){
			$("#j-messages").html("<p>Идет индексация сайта. Пожалуйста, подождите...</p>");
		}',
		'success'=>'js:function(data){
			$("#j-messages").html("<p>Индексация завершена успешно!</p>");
		}',
		'error'=>'js:function(data){
			$("#j-messages").html("<p>Ошибка при индексации сайта. Пожалуйста, повторите попытку.</p>");
		}',
	));
?>
<br/><br/>

<div id = "j-messages"></div>