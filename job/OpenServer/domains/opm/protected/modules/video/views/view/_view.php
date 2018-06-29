<?php 
	$url =  Yii::app()->createUrl('video/view/getAccess',array('n'=>$data->id));
	$path = Yii::getPathOfAlias('webroot').DS."upload".DS.Yii::app()->controller->module->folder.DS.$data->id.".jpg";
	if(file_exists($path)) {
		$img = '<div class = "col-md-4 b-trade_img"><a href = "'.$url.'"><img src = "/upload/'.Yii::app()->controller->module->folder.'/'.$data->id.'.jpg" title = "'.$data->name.'" alt = "'.$data->name.'" /></a></div>';
		$class = "col-md-8";
	} else {
		$class = "col-md-12";
		$img = '';
	}
	$description = preg_replace('/(<br \/>){2,}/', '<br />', $data->description);
?>
<div class = "b-trade_preview border_box">
	<?=$img?>
	<div class = "<?=$class?>">
		<article class = "g-styles">
			<h2 class = "l-item_title"><?=$data->name?></h2>
			<?=$data->description?>
		</article>
	
		<div class = "b-trade_preview_btns">
			<!--<a class = "btn a-get_view_preview" href = "#" data-number = "<?=$data->id?>">Preview</a>-->
			
			<a class = "btn" href = "<?=$url?>" data-number = "<?=$data->id?>">
				Get Access for $ <?=Helper::viewPrice($data->price);?>
			</a>
			
			<?php if(Yii::app()->user->checkAccess('admin')):?>
				<a class = "btn" href = "<?=Yii::app()->createUrl('video/view/view',array('id'=>$data->id))?>" data-number = "<?=$data->id?>">View</a>
			<?php endif;?>
		</div>
	</div>
</div>

