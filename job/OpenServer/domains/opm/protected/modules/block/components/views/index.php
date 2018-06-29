<?php 
if(count($dataProvider)>0) {
	echo '<div id= "b-block_area_'.$this->view.'" class = "b-block_area b-block_area_'.$this->view.'">';
	foreach($dataProvider as $data) {
		if($data->view_title == 0)
			$styles = ' class="g-hidden"';
		else 
			$styles = '';
?>
	<div class = "b-site_block b-view_block<?=$data->id?>" id = "b-view_block<?=$data->id?>">
		<<?=$this->tag.$styles?>><?=$data->title?></<?=$this->tag?>>
		<div class = "b-site_block_content"><?=$data->content;?></div>
	</div>
<?php 		
	}
	echo '</div>';
}