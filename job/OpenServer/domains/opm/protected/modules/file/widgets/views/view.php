<?php
if(count($dataprovider)>0):
	echo '<ul id= "j-photobox_gallery_'.$this->modelName.'" class = "b-images_view j-photobox_gallery">';

	foreach($dataprovider as $data):
	
	$file = Yii::getPathOfAlias('webroot').DS.'upload'.DS.Yii::app()->getModule('file')->uploadFolder.DS.$data->folder.DS.$this->type.DS;
	
	if(Yii::app()->cFile->set($file.$data->file)->exists)
		$img = '<img alt = "'.strip_tags($data->description).'" class = "j-lazy" src = "/upload/'.Yii::app()->getModule('file')->uploadFolder.'/'.$data->folder.'/'.$this->type.'/'.$data->file.'"/>';
	else
		$img = '<img alt = "'.strip_tags($data->description).'" class = "j-lazy" src = "/images/'.Yii::app()->getModule('file')->noImage.'/>';
	?>
	<li class = "l-inline_block">
		<a href = "/upload/<?=Yii::app()->getModule('file')->uploadFolder;?>/<?=$data->folder;?>/original/<?=$data->file;?>">
			<?=$img;?>
		</a>
		<?php if($this->description){?>
			<p><?=$data->description?></p>
		<?php }?>
	</li>
	<?php endforeach;	
	echo '</ul>';
	JS::add('photobox_init', "$('.j-photobox_gallery').photobox('a',{ 'time':0, 'loop':false, 'afterClose': function(){}});");
	//if(Yii::app()->request->isAjaxRequest)
	?>

<script type = "text/javascript">
$('.j-photobox_gallery').photobox('a',{ 'time':0, 'loop':false, 'afterClose': function(){}});
</script>

<?php
endif;
?>