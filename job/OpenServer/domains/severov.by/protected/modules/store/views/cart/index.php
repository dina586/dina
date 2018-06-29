<?php $this->seo('Корзина');?>
<div class = "j-shopping_cart b-shopping_cart">
	<h1 class = "l-page_title"><?=$this->pageTitle;?></h1>
	<div class = "g-clear_fix"></div>
	
	<?php if($position = Yii::app()->shoppingCart->isEmpty(1) == true):?>
		<article class = "b-transit">
			<p>Ваша корзина пуста! Посетите магазин!</p>
		</article>
	<?php else : ?>
		<table class = "d-cart_table">
			<thead>
			<tr>
				<th></th>
				<th>Название</th>
				<th>Цена за единицу</th>
				<th>Кол-во</th>
				<th>Всего</th>
				<th></th>
			</tr>
			</thead>
			<?php 
		$cart = Yii::app()->shoppingCart->getPositions();
		
		foreach($cart as $view) {
			if(isset($view['share_price']) && $view['share_price'] != 0)
				$cost = $view['share_price'];
			else
				$cost = $view['price'];
			$url = Yii::app()->createUrl('store/product/view', array('url'=>$view['url']));
			
			$img = Helper::getCover($view['id'], 'Product', $url);
			$imageLink = '<a href = "'.$url.'">'.$img.'</a>';
			$nameLink = '<a href = "'.$url.'">'.$view['name'].'</a>';
			$deleteLink = '<a class = "l-store_button" href = "'.Yii::app()->createUrl('store/cart/cartProdDelete', array('id'=>$view['id'])).'">Удалить</a>';
			$input = '<input type = "hidden" name = "prod_type" value = "catalog" class = "k-prod_type"/>';
		?>
			<tr>
				<td><?=$imageLink;?></td>
				<td><?=$nameLink;?></td>
				<td>
					<?=BsHtml::textField('prod_number', $view->getQuantity(), array('class'=>'j-cart_number'))?>
					<input type = "hidden" name = "prod_id" value = "<?=$view['id'];?>" class = "k-prod_id"/>
					<?=$input;?>
				</td>
				<td class = "k-one_prod l-nowrap"><?=number_format($view->getPrice(), 0, '', ' ')?></td>
				<td class = "j-sum_price l-nowrap"><?=number_format($view->getSumPrice(), 0, '', ' ');?></td>
				<td class = "a-cart_delete">
					<?=$deleteLink;?>
				</td>
			</tr>
		<?php }	?>
			</tbody>
			<tfoot>
				<td colspan="4" class = "l-align_right">Всего</td>
				<td colspan="2"><span class = "d-cart_cost l-nowrap"><?=number_format(Yii::app()->shoppingCart->getCost(), 0, '', ' ');?></span></td>
			</tfoot>
		</table>
		
		<div class = "g-clear_fix"></div>
		
		<nav class = "j-shopping_cart_links">
			<a class = "l-store_button" href = "<?php echo Yii::app()->createUrl('/store/cart/order');?>">Оформить заказ</a>
			<a class = "l-store_button" href = "<?php echo Yii::app()->createUrl('/store/cart/clearCart');?>">Очистить корзину</a>
		</nav>

		<?php endif; ?>
</div>
