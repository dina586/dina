<div class="l-base_wraper">

	<article class = "g-styles">
		<section class = "l-page_title_wrap">
			<h1 class = "l-page_title"><?=$model->name;?></h1>
		</section>
		<?=$model->content;?>
	</article>

</div>

<div class ="clearfix"></div>

<?=Helper::editLink(Yii::app()->createUrl(Yii::app()->controller->module->id.'/'.Yii::app()->controller->id.'/update', array('id'=>$model->id)));?>