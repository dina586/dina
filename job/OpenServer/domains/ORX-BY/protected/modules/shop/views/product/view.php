<?php
if($model->seo_title == '')
	$seoTitle = $model->name;
else 
	$seoTitle = $model->seo_title;
$this->seo($seoTitle, $model->seo_keywords, $model->seo_description);

if(Yii::app()->cFile->set(ROOT_PATH.DIRECTORY_SEPARATOR.'upload'.DIRECTORY_SEPARATOR.'product'.DIRECTORY_SEPARATOR.$model->id.DIRECTORY_SEPARATOR.'original'.DIRECTORY_SEPARATOR.$model->front_image)->exists && $model->front_image != ''){
	$img = '<figure><img src = "/upload/product/'.$model->id.'/original/'.$model->front_image.'"/></figure>';
} else 
	$img = '<figure><img src = "/images/no-img.png" /></figure>';
?>
<div class = "b-product_view b-add_to_cart">
	<h3 class = "page_title"><?php echo $model->name;?></h3>
	<div class = "l-material">

				<?php 
				$parent = $i = 0;
				foreach($model->catalog as $catalog) {
					if($i > 0 && $parent !=$catalog->parent_id)
						break;
						
					if($i ==0) 
						$parent = $catalog->id;
					
					$catalogArr[$catalog->name] = Yii::app()->createUrl('shop/catalog/view', array('id'=>$catalog->id));
					$i++;
				}
				
				$catalogArr[$model->name] = Yii::app()->createUrl('shop/product/view', array('id'=>$model->id));

				$this->widget('zii.widgets.CBreadcrumbs', array(
					'links'=>$catalogArr,
				)); 
			?>

		<div class = "b-product_images">
			<?=$img;?>
			<?php $this->viewImages(ROOT_PATH.DIRECTORY_SEPARATOR.'upload'.DIRECTORY_SEPARATOR.'product'.DIRECTORY_SEPARATOR.$model->id.DIRECTORY_SEPARATOR, $model->id);?>
		</div>
		<article>
			<section class = "b-product_rating">
			<?php if($rating != 0) {?>
			<b>Рейтинг:</b>
			<?
				$this->widget('CStarRating', array(
					'name'=>'product_star',
					'allowEmpty'=>false,
					'value'=>$rating,
					'readOnly' => true,
					'callback' => 'function(value) {}'
				));
			}?>
			</section>
			<div class = "g-clear_fix"></div>
		<?=$model->content;?>
		<div class = "g-clear_fix"></div>
			
		<div class = "g-clear_fix"></div>
		<?php 
					$block = Block::viewBlock(5);
					foreach($block as $view){
						echo $view['description'];
						echo '<div class = "g-clear_fix"></div>';
					}
		?>
		
		<div class = "g-clear_fix"></div>
		
		<?php 
		if(isset($model->share_price) && $model->share_price != 0) {
				$cost =$model->share_price;		
				$class = "b-share_price";	
			}
			else {
				$cost = $model->price;
			}
		?>
		<?php if(isset($model->share_price) && $model->share_price != 0) {?>
			<div class = "b-price <?php echo $class;?>">
				<p><b>Старая цена: </b><span class = "k-price"><?=$model->price?></span></p>
			</div>
			<div class = "b-price">
				<p><b>Цена: </b><span class = "k-share_price"><?=$model->share_price?></span></p>
			</div>
			<?php } else {?>
			<div class = "b-price">
				<p><b>Цена: </b><span class = "k-share_price"><?=$model->price?></span></p>
			</div>
			<?php }?>
		<input type = "hidden" name = "k-prod_id" value = "<?=$model->id;?>" />
		<input type = "hidden" name = "k-prod_cost" value = "<?=$cost;?>" />
		<a class = "add_to_cart_button j-add_to_cart" href = "#">купить</a>
		<div class = "g-clear_fix"></div>
		</article>
	</div>
</div>

<div class = "g-clear_fix"></div>
<div class = "g-stock_inner">
<?php $this->widget('application.modules.stock.widgets.StockWidget', array('id'=>2))?>
</div>
<div class = "g-clear_fix"></div>

<div class = "b-recently_view">
	<h3 class="page_title">Недавно просматривали: </h3>
	<div class = "l-material">

	<?php $this->widget('zii.widgets.CListView', array(
		'dataProvider'=>$dataProvider,
		'itemView'=>'_recently',
		'template'=>"{items}{pager}",
		'ajaxUpdate'=> FALSE,
		'pager' => array(
	    	'header'=>false,
			'prevPageLabel'=>'',
			'nextPageLabel'=>'',
		)
	)); ?>
	</div>
</div>
<div class = "l-material">
	<div class = "b-product_comments">
	<h3 class = "page_title">Отзывы о товаре</h3>
	<?php $this->widget('zii.widgets.CListView', array(
		'dataProvider'=>$commentData,
		'itemView'=>'/comment/_view',
		'template'=>"{items}{pager}",
		'emptyText'=> '',
		'pager' => array(
	    	'header'=>false,
			'prevPageLabel'=>'',
			'nextPageLabel'=>'',
		)
	)); ?>
	<div class = "g-clear_fix"></div>
	<?php if(Yii::app()->user->hasFlash('commentSubmitted')): ?>
		<?php echo Yii::app()->user->getFlash('commentSubmitted'); ?>
	<?php else: 
		$this->renderPartial('/comment/_form',array(
			'model'=>$comment,
		)); ?>
	<?php endif; ?>
	</div>
</div>
