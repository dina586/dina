<?php $this->seo('site Indexing'); ?>
<h3 class = "admin_title"><?=$this->pageTitle;?></h3>
<br/>
<?php
echo CHtml::ajaxLink(
	're-index the site', 
	Yii::app()->createUrl('search/view/create'),
	array(
		'beforeSend'=>'js:function(){
			$("#j-messages").html("<p>There is a site indexing. Please wait...</p>");
		}',
		'success'=>'js:function(data){
			$("#j-messages").html("<p>Indexing completed successfully!</p>");
		}',
		'error'=>'js:function(data){
			$("#j-messages").html("<p>Error when indexing your site. Please try again.</p>");
		}',
	));
?>
<br/><br/>
<?php
echo CHtml::ajaxLink(
	'Optimize the index file', 
	Yii::app()->createUrl('search/view/optimization'),
	array(
		'beforeSend'=>'js:function(){
			$("#j-messages").html("<p>Goes optimization index file. Please wait...</p>");
		}',
		'success'=>'js:function(data){
			$("#j-messages").html("<p>Optimization completed successfully!</p>");
		}',
		'error'=>'js:function(data){
			$("#j-messages").html("<p>Error while optimizing the index. Please try again.</p>");
		}',
	));
?>
<br/>
<div id = "j-messages"></div>