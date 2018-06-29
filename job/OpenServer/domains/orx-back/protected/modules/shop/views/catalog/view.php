<?php
if($model->seo_title == '')
	$seoTitle = $model->name;
else 
	$seoTitle = $model->seo_title;
$this->seo($seoTitle, $model->seo_keywords, $model->seo_description);
?>
<h3 class="page_title"><?php echo $model->name?></h3>
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
	<div class = "g-clear_fix"></div>
	<article class = "b-catalog_content">
		<?=$model->content;?>
	</article>
</div>


