<div class = "b-product_view b-add_to_cart">
	<h3 class = "page_title">Галерея</h3>
	<div class = "l-material">
		<div class = "g-clear_fix"></div>
		
		<? if (!Yii::app()->user->isGuest) {?>
	
		<div class = "g-clear_fix"></div>
		<?}?>
		
	<?php 
	$this->viewGallery(ROOT_PATH.DIRECTORY_SEPARATOR.'upload'.DIRECTORY_SEPARATOR.'gallery'.DIRECTORY_SEPARATOR.'');
	
	?>

	</div>
</div>
