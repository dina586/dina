<div class="l-base_wraper">
	

	
	<div class = "g-clear_fix"></div>
	
	<article class = "g-styles">
		<div class = "l-page_title_wrap">
			<h1 class = "l-page_title"><?=$model->name;?></h1>
		</div>
		<?=$model->site_content;?>
	</article>

</div>
	<div class = "g-clear_fix"></div>

<?=Helper::editLink(Yii::app()->createUrl(Yii::app()->controller->module->id.'/'.Yii::app()->controller->id.'/update', array('id'=>$model->id)));?>