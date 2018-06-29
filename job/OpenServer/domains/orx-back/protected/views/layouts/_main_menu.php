<div id="myslidemenu" class="jqueryslidemenu">
	<div class = "g-bant"><img src = "/images/ded.png"/></div>
	<ul>
		<li>
			<a href = "/">главная</a>
		</li>
		<li class = "menu_price">
			<a href = "<?=Yii::app()->createUrl('/shop/catalog')?>">КАТАЛОГ</a>
			<?php TreeView::viewMenu(-1);?>
		</li>
		<li>
			<a href = "<?=Yii::app()->createUrl('/site/page', array('view'=>'about'));?>">о компании</a>
		</li>
		<li>
			<a href = "<?=Yii::app()->createUrl('/site/page', array('view'=>'delivery'));?>">доставка</a>
		</li>
		<li>
			<a href = "<?=Yii::app()->createUrl('/about')?>">ОБ ОРХИДЕЯХ</a>
		</li>
		<li>
			<a href = "<?=Yii::app()->createUrl('/gallery')?>">фото</a>
		</li>
		<li>
			<a href = "<?=Yii::app()->createUrl('/opinions')?>">отзывы</a>
		</li>
		<li class = "r-last">
			<a href = "<?=Yii::app()->createUrl('/site/contact');?>">контакты</a>
		</li>
		<li class = "r-last r-cart">
			<a href = "<?=Yii::app()->createUrl('/shop/cart/index')?>">
				<img src = "/images/cart.png"/>
			</a>
		</li>
	</ul>
	<?php 
	$cart = Yii::app()->shoppingCart;
	if($cart->isEmpty(1)) {
		$style = "style=display:none;";
	}?>
	<div class = "b-card_items_preview j-card_items_preview" <?=$style;?>>
				<table>
					<tr>
						<td class = "card_items_preview_td">в корзине</td>
						<td><span id = "j-items_number"><?=$cart->getItemsCount()?></span> шт.</td>
					</tr>
					<tr>
						<td class = "card_items_preview_td">общая сумма</td>
						<td id = "j-items_sum"><?=$cart->getCost()?></td>
					</tr>
				</table>
			</div>
</div>
