<?php
if (count($dataprovider) > 0):
	echo '<div class="grid masonry four-column clearfix">';
	foreach ($dataprovider as $data):

		$file = Yii::getPathOfAlias('webroot').DS.'upload'.DS.Yii::app()->getModule('file')->uploadFolder.DS.$data->folder.DS.'thumbnail'.DS;

		if (Yii::app()->cFile->set($file.$data->file)->exists)
			$img = '<img alt = "'.strip_tags($data->description).'" class = "j-lazy" src = "/upload/'.Yii::app()->getModule('file')->uploadFolder.'/'.$data->folder.'/thumbnail/'.$data->file.'"/>';
		else
			continue;
		?>
		<div class="thumb masonry-item" data-project-categories="photography">
			<a class="lightbox" rel="photo-post-gallery" href = "/upload/<?=Yii::app()->getModule('file')->uploadFolder; ?>/<?=$data->folder; ?>/original/<?=$data->file; ?>">
				<?=$img; ?>
			</a>
		</div>
		<?php
	endforeach;
	echo '</div>';
endif;
?>
