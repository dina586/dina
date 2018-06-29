<?php 
	$cart = Yii::app()->shoppingCart;
	if($cart->isEmpty(1)) {
		$fullClass = 'g-hidden';
		$emptyClass = 'g-visible';
	} else {
		$fullClass = 'g-visible';
		$emptyClass = 'g-hidden';
	}
?>

<a class="j-shopping_cart_preview g-cart_preview" href="<?=Yii::app()->createUrl('store/cart/index');?>">
	<span class="b-cart_empty <?=$emptyClass?> j-shopping_cart_empty"> 
		Add Products
	</span>
	<span class="b-cart_full <?=$fullClass?> j-shopping_cart_full">
		<span>Total: <var class="d-cart_total"><?=$cart->getItemsCount()?></var></span><br>
		<span>Sum: $ <var class="d-cart_cost"><?=Helper::viewPrice($cart->getCost());?></var></span>
	</span>
</a>

