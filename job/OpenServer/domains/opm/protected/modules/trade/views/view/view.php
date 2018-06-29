<?php 
	$url = Yii::app()->createUrl(Yii::app()->controller->module->id.'/'.Yii::app()->controller->id.'/view', array('url'=>$model->url));

	$path = Yii::getPathOfAlias('webroot').DS."upload".DS.Yii::app()->controller->module->folder.DS.$model->id.".jpg";
	if(file_exists($path)) {
		$img = '<div class = "col-md-4 b-trade_img"><a href = "'.$url.'"><img src = "/upload/'.Yii::app()->controller->module->folder.'/'.$model->id.'.jpg" title = "'.$model->name.'" alt = "'.$model->name.'" /></a></div>';
		$class = "col-md-8";
	} else {
		$class = "col-md-12";
		$img = '';
	}
?>

<div class="l-base_wraper">
	
	
		<div class = "l-page_title_wrap">
			<h1 class = "l-page_title"><?=$model->name;?></h1>
		</div>
		<div class = "g-clear_fix"></div>
	<?=$img?>
	<article class = "<?=$class?> g-styles">
		
		<?=$model->content;?>
	</article>

</div>
<div class = "g-clear_fix"></div>

<?=Helper::editLink(Yii::app()->createUrl(Yii::app()->controller->module->id.'/'.Yii::app()->controller->id.'/update', array('id'=>$model->id)));?>