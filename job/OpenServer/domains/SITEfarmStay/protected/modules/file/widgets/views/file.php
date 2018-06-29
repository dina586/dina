<?php
if(count($dataprovider)>0):
	echo '<ul class = "b-file_view">';

	foreach($dataprovider as $data):
	
	$file = Yii::getPathOfAlias('webroot').DS.'upload'.DS.Yii::app()->getModule('file')->uploadFolder.DS.$data->folder.DS.'file'.DS.$data->file;
	$cFile = Yii::app()->cFile->set($file);
	
	if(!$cFile->exists)
		continue;
	
	$ext = $cFile->getExtension();

	$icon = Yii::getPathOfAlias('webroot').DS.'images'.DS.'system'.DS.'file_manager'.DS.'small_icons'.DS.$ext.'.png';
	
	if(Yii::app()->cFile->set($icon)->exists)
		$img = '<img class = "j-lazy" src = "/images/system/file_manager/small_icons/'.$ext.'.png" alt = "'.$ext.'"/>';
	else
		$img = '<img src = "/images/system/file_manager/no_icon_small.png"/>';
	$description = $data->description==''?$data->file:$data->description;
	?>
	
	<li class = "l-inline_block">
		<span class = "b-file_icon l-inline_block">
			<?=$img;?>
		</span>
		<a class = "l-inline_block" href = "/upload/<?=Yii::app()->getModule('file')->uploadFolder;?>/<?=$data->folder;?>/file/<?=$data->file;?>">
			<?=$description;?>
		</a>
	</li>
	<?php endforeach;	
	echo '</ul>';
endif;
?>
