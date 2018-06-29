<?php 
$ext = explode('.', $data->file);
$ext = end($ext);

$viewExt = '<span class = "b-file_manager_ext">'.$ext.'</span>';

if($data->file_type == 'image')
	$file = Yii::getPathOfAlias('webroot').DS.'upload'.DS.Yii::app()->getModule('file')->uploadFolder.DS.$data->folder.DS.'admin'.DS.$data->file;
else 
	$file = Yii::getPathOfAlias('webroot').DS.'images'.DS.'system'.DS.'file_manager'.DS.'big_icons'.DS.$ext.'.png';

if(Yii::app()->cFile->set($file)->exists) {
	if($data->file_type == 'image')
		$img = '<img src = "/upload/'.Yii::app()->getModule('file')->uploadFolder.'/'.$data->folder.'/admin/'.$data->file.'"/>';
	else {
		$img = '<img src = "/images/system/file_manager/big_icons/'.$ext.'.png"/>';
		$viewExt = '';
	}
} else
	$img = '<img src = "/images/system/file_manager/no-img.png"/>';

if($data->file_type == 'file')
	$img = '<a href = "/upload/'.Yii::app()->getModule('file')->uploadFolder.'/'.$data->folder.'/file/'.$data->file.'">'.$img.'</a>';
	
	
if($cover == true && $data->cover == 1)
	$viewCover = '<span class = "b-file_manager_cover j-file_manager_cover">'.Yii::t('admin', 'Cover').'</span>';
else
	$viewCover = '';

$data->description = str_ireplace(Yii::app()->params['breaks'], " ", $data->description);
?>

<div id = "j-file_manager_admin_<?=$data->id?>" data-item-id = "<?=$data->id?>" class = "b-file_manager_item d-file_manager_item">
	<nav class = "b-file_manager_btns">
		<a class = "file_manager_move_bottom j-file_manager_move_bottom" href = "#"></a>
		<a class = "file_manager_move_top j-file_manager_move_top" href = "#"></a>
	</nav>
	
	<section class = "b-file_manager_file l-inline_block j-file_manager_file">
		<?=$viewCover?>
		<?=$viewExt;?>
		<?=$img?>
	</section>
	
	<section class = "b-file_manager_area l-inline_block">
		<header><?=Yii::t('admin', 'Description');?></header>
		
		<div class = "b-file_manager_textarea">
			<?php 
				$breaks = array("<br />","<br>","<br/>");
				$data->description = str_ireplace($breaks, "", $data->description);
				echo BsHtml::textAreaControlGroup('file_manager_textarea'.$data->id, $data->description, array('class'=>'j-file_manager_description'));
			?>
		</div>
		
		<footer>
			<?php if($cover == true && $data->file_type == 'image'):?>
			<a class = "a-file_manager_cover" href = "<?=Yii::app()->createUrl('file/upload/cover', array('id'=>$data->id));?>"><?=Yii::t('admin', 'Set cover');?></a>
			<span>|</span>
			<?php endif;?>
			<a class = "a-file_manager_item_delete" href = "<?=Yii::app()->createUrl('file/upload/delete', array('id'=>$data->id));?>"><?=Yii::t('main', 'Delete');?></a>
		</footer>
	</section>
</div>