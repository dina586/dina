<div class = "b-about">
	<h3 class = "page_title">Корзина</h3>
	<div class = "l-material">
		<div class = "b-cart b-shopping_cart">
		
			
		<?php if($position = Yii::app()->shoppingCart->isEmpty(1) == true):?>
		<article class = "b-transit">
			<p>Ваша корзина пуста! Посетите магазин!</p>
		</article>
		<?php 
		else : ?>
		<table class = "cart_table">
			<thead>
			<tr>
				<td></td>
				<td>Название</td>
				<td>Кол-во</td>
				<td>Цена за единицу</td>
				<td>Итого</td>
				<td></td>
			</tr>
			</thead>
			<tbody>
		<?php 
		$cart = Yii::app()->shoppingCart->getPositions();
		foreach($cart as $view) {
			if(is_file(ROOT_PATH.DIRECTORY_SEPARATOR.'upload'.DIRECTORY_SEPARATOR.'product'.DIRECTORY_SEPARATOR.$view['id'].DIRECTORY_SEPARATOR.'thumbnails'.DIRECTORY_SEPARATOR.$view['front_image'])){
				$img = '<img src = "/upload/product/'.$view['id'].'/thumbnails/'.$view['front_image'].'"/>';
				}
			else {
				$img = '<img src = "/images/no-img.png"/>';
			}
			$url = Yii::app()->createUrl('shop/product/view', array('id'=>$view['id']));
			if(isset($view['share_price']) && $view['share_price'] != 0) {
					$cost = $view['share_price'];			
				}
				else {
					$cost = $view['price'];
				}
			echo '<tr>';
				echo '<td>'.$img.'</td>';
				echo '<td><a href = "'.$url.'">'.$view['name'].'</a></td>';
				echo '<td><input class = "cart_number" type = "text" name = "prod_number" value = "'.$view->getQuantity().'"/>
				<input type = "hidden" name = "prod_id" value = "'.$view['id'].'"/></td>';
				echo '<td class = "one_prod">'.$view->getPrice().'</td>';
				echo '<td class = "sum_price">'.$view->getSumPrice().'</td>';
				echo '<td class = "a-delete_prod"><a href = "#">удалить</a></td>';
			echo '</tr>';
		}
		
		?>
			</tbody>
			<tfoot>
				<td></td>
				<td></td>
				<td></td>
				<td>Всего</td>
				<td><?php echo Yii::app()->shoppingCart->getCost();?></td>
				<td></td>
			</tfoot>
		</table>
		
		<a class = "j-cart_link" href = "<?php echo Yii::app()->createUrl('/shop/cart/order');?>">Оформить заказ</a>
		<a class = "j-cart_link" href = "<?php echo Yii::app()->createUrl('/shop/cart/clearCart');?>">Очистить корзину</a>
		
		<div class = "g-clear_fix"></div>
		
		
		<?php endif; ?>
		
		</div>
	</div>
</div>
