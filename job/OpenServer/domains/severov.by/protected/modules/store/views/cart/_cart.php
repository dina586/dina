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

<a class = "j-shopping_cart_preview g-cart_preview" href = "<?=Yii::app()->createUrl('store/cart/index')?>">
	<span class = "b-cart_empty <?=$emptyClass?> j-shopping_cart_empty">Корзина пуста</span>
	<span class = "b-cart_full <?=$fullClass?> j-shopping_cart_full">
		<span>Всего: <var class = "d-cart_total"><?=$cart->getItemsCount()?></var></span>
		<span>Сумма: <var class = "d-cart_cost"><?=number_format($cart->getCost(), 0, '', ' ')?></var></span>
	</span>
</a>