<?php
if (count($dataProvider) > 0):
	?>
	<?php foreach ($dataProvider as $data) { 
		
	$cover = FileManager::model()->find(array(
		'order' => 'position, date DESC',
		'condition' => 'model_id=:model_id AND model_name=:model_name AND file_type=:file_type AND cover = 1',
		'params' => array(':model_id' => $data->id, ':model_name' => get_class($data), ':file_type' => 'image')
	));
if($cover !== null)
	$bg = '/upload/'.Yii::app()->getModule('file')->uploadFolder.'/'.$cover->folder.'/thumbnail/'.$cover->file.'';
else
	$bg = '/images/no_object_img.jpg';

?>
		<div style="background-image: url('<?=$bg;?>')" class="b-project_img os-animation" data-os-animation="fadeIn" data-os-animation-delay="0.5s">
			<a href = "<?=Yii::app()->createUrl('/objects/view/view', ['id'=>$data->id])?>" class = "b-project_img_hover">
				<div class = "b-project_link">
					<span><?=$data->name;?></span>
				</div>
				<div class = "b-project_work">
					<p>Подробнее <span>></span></p>
				</div>
			</a>
		</div>
	<?php } ?> 

<?php endif; ?>