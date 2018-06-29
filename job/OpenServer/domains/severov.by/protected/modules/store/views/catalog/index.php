<div class = "l-base_wraper b-catalog">
	<div class = "l-page_title_wrap">
		<h1 class = "l-page_title"><?=$this->pageTitle;?></h1>
	</div>
	
	<div class = "a-links_container">
	<?php
		if(count($dataProvider)>0) {
			$i = 0;
			foreach($dataProvider as $data) {
				$i++;
				$class = $i%4 ? '' : ' r-store_preview';
				$path = Yii::getPathOfAlias('webroot').DS."upload".DS.Yii::app()->controller->module->catalogFolder.DS.$data->id.".jpg";
				if(file_exists($path))
					$src = '/upload/'.Yii::app()->controller->module->catalogFolder.'/'.$data->id.'.jpg';
				else
					$src = '/images/catalog-no-img.png';
	?>
		<div class = "b-catalog_preview l-inline_block<?=$class?>">
			<div class = "b-catalog_preview_title">
				<a href = "<?=Yii::app()->createUrl('store/catalog/view', array('url'=>$data->url))?>"><?=$data->name;?></a>
			</div>
			<div class = "b-catalog_preview_image">
				<a href = "<?=Yii::app()->createUrl('store/catalog/view', array('url'=>$data->url))?>">
					<img src = "<?=$src;?>" alt = "<?=$data->name?>" title = "<?=$data->name?>"/>
				</a>
			</div>
		</div>
	<?php 		
			}
		}
	?>
	</div>
	
</div>
<?php
