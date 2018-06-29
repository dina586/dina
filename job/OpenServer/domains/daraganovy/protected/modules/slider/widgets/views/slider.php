<?php 
if(count($dataProvider)>0):
?>
	<div class = "b-slider_jcarousel_wrap">
		<div class = "l-jcarousel j-jcarousel b-slider_jcarousel">
			<ul>
			<?php foreach($dataProvider as $data) { 
			if($data->link != '')
				$url = $data->link;
			else 
				$url = '#';
			?>
				<li>
					<a href = "<?=$url?>">
						<img src = "/upload/<?=Yii::app()->getModule('slider')->folder;?>/<?=$data->id;?>.jpg" alt = "<?=$data->name;?>" title = "<?=$data->name;?>"/>
					</a>				
				</li>

			<?php }?>
			</ul>
		</div>
		<a href="#" class="b-control-prev j-jcarousel-control-prev">&lsaquo;</a>
		<a href="#" class="b-control-next j-jcarousel-control-next">&rsaquo;</a>
	</div>
<?php 
Yii::app()->clientScript->registerPackage('jcarousel');
JS::add('jcarousel_init23', 'jcarousel_init(".j-jcarousel", '.Settings::getVal('slider_scroll_speed').')');		
endif;
?>