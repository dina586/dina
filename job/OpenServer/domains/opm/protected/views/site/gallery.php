<div class="l-base_wraper">
	
	<div class = "g-clear_fix"></div>
	
	<article class = "g-styles">
		<div class = "l-page_title_wrap">
			<h1 class = "l-page_title"><?=$model->name;?></h1>
		</div>
		<?=$model->content;?>
	</article>
	
	<div class = "g-clear_fix"></div>
	
	<div class = "b-site_gallery">
		<?php 
			$this->widget('application.widgets.GalleryWidget', array('id'=>$model->id, 'modelName'=>get_class($model), 'type'=>'thumbnail', 'cover'=>false));
		?>
	</div>
	

</div>

<?=Helper::editLink(Yii::app()->createUrl('service/gallery/update', array('id'=>$model->id)));?>