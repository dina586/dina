<aside class = "l-left c-left">
	<section class = "b-left_catalog">
		<h2><a href = "<?=Yii::app()->createUrl('store/catalog/index')?>">Каталог продукции</a></h2>
		<?php
			$store = new StoreHelper();
			echo $store->viewMenu();
		?>
	</section>
	
	<section class = "b-left_news_preview">
		<h2>Интересно знать</h2>
		<?php $this->widget('application.modules.news.components.LatestNews');?>
	</section>
	
	<section class = "b-left_banners">
		<?php $this->widget('application.modules.block.components.GetBlocks', array('view'=>'left_banner'));?>
	</section>
</aside>