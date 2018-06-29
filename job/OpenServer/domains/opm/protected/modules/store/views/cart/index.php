<?php $this->seo('Shopping cart');?>
<div class = "j-shopping_cart b-shopping_cart">
	<h1 class = "l-page_title"><?=$this->pageTitle;?></h1>
	<div class = "g-clear_fix"></div>
	
	<?php if($position = Yii::app()->shoppingCart->isEmpty(1) == true):?>
		<article class = "b-transit">
			<p>Your cart is empty! Please, visit the shop!</p>
		</article>
	<?php else : ?>
		<div class="table-responsive">
		<table class = "d-cart_table table table-bordered">
			<thead>
			<tr>
				<th></th>
				<th>Name</th>
				<th>Number</th>
				<th>Cost per item, $</th>
				<th>Total, $</th>
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
			$deleteLink = '<a class = "l-store_button" href = "'.Yii::app()->createUrl('store/cart/cartProdDelete', array('id'=>$view['id'])).'">Delete</a>';
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
				<td class = "l-nowrap">$ <span class = "k-one_prod"><?=Helper::viewPrice($view->getPrice())?></span></td>
				<td class = "l-nowrap">$ <span class = "j-sum_price"><?=Helper::viewPrice($view->getSumPrice());?></span></td>
				<td class = "a-cart_delete">
					<?=$deleteLink;?>
				</td>
			</tr>
		<?php }	?>
			</tbody>
			<tfoot>
				<tr>
				<td colspan="4" class = "l-align_right">Total</td>
				<td colspan="2"><span class = "l-nowrap">$ <span class = "d-cart_cost"><?=Helper::viewPrice(Yii::app()->shoppingCart->getCost());?></span></span></td>
				</tr>
			</tfoot>
		</table>
		</div>
		<div class = "g-clear_fix"></div>
		
		<nav class = "j-shopping_cart_links">
			<a class = "l-store_button" href = "<?php echo Yii::app()->createUrl('/store/cart/order');?>">Checkout</a>
			<a class = "l-store_button" href = "<?php echo Yii::app()->createUrl('/store/cart/clearCart');?>">Clear cart</a>
		</nav>

		<?php endif; ?>
</div>
