<?php 
if(count($dataProvider)>0):
?>
	<div class = "l-jcarousel j-jcarousel b-stock_jcarousel">
		<ul>
		<?php foreach($dataProvider as $data) { 
		if($data->link != '')
			$url = $data->link;
		else 
			$url = Yii::app()->createUrl('stock/view/view', array('url'=>$data->url));
		?>
			<li>
				<a href = "<?=$url?>">
					<img src = "/upload/<?=Yii::app()->getModule('stock')->folder;?>/<?=$data->id;?>.jpg" alt = "<?=$data->name;?>" title = "<?=$data->name;?>"/>
				</a>				
			</li>
		<?php }?>
		</ul>
	</div>
<?php 
Yii::app()->clientScript->registerPackage('jcarousel');
JS::add('jcarousel_init23', 'jcarousel_init(".j-jcarousel", '.Settings::getVal('stock_scroll_speed').')');		
endif;
?>