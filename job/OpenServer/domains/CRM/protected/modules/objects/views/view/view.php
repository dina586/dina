<?php $widget = $this->widget('file_uploader.GalleryWidget', array('id' => $model->id, 'modelName' => get_class($model), 'type' => 'thumbnail'), true);?>
<div class = "g-site_width">
	<div class = "b-object">
		<h1 class = "l-page_title"><?=$model->name;?></h1>
		<?php if(trim($widget) != ''):?>
		<div class = "b-house_gallery" id = "j-house_gallery">
			<?=$widget; ?>
		</div>
		<?php endif;?>
		<div class = "g-clear_fix"></div>
		<div class = "g-styles">
			<?=$model->content;?>
		</div>
		<div class = "g-clear_fix"></div>
		<a class="l-order_btn" href="/#projects">Вернуться на главную</a>
		<div class = "g-clear_fix"></div>
		<?=Helper::editLink(Yii::app()->createUrl(Yii::app()->controller->module->id.'/'.Yii::app()->controller->id.'/update', array('id' => $model->id))); ?>
	</div>
</div>

