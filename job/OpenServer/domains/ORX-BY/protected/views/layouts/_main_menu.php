<div id="myslidemenu" class="jqueryslidemenu">
	<div class = "g-bant"><img src = "/images/ded.png"/></div>
	<ul>
		<li>
			<a href = "/">ГЛАВНАЯ</a>
		</li>
		
		<li>
			<a href = "<?=Yii::app()->createUrl('/site/page', array('view'=>'about'));?>">О КОМПАНИИ</a>
		</li>
                <li>
			<a href = "<?=Yii::app()->createUrl('/shop/catalog')?>">КАТАЛОГ ПРОДУКЦИИ</a>
			<?php TreeView::viewMenu(-1);?>
		</li>
		<li>
			<a href = "<?=Yii::app()->createUrl('/site/page', array('view'=>'delivery'));?>">ДОСТАВКА</a>
		</li>
		<!--<li>
			<a href = "<?=Yii::app()->createUrl('/about')?>">ОБ ОРХИДЕЯХ</a>
		</li>
		<li>
			<a href = "<?=Yii::app()->createUrl('/gallery')?>">фото</a>
		</li>-->
                <li class = "r-last">
			<a href = "<?=Yii::app()->createUrl('/site/contact');?>">КОНТАКТЫ</a>
		</li>
		<li>
			<a href = "<?=Yii::app()->createUrl('/opinions')?>">ОТЗЫВЫ</a>
		</li>
		
		<li class = "r-last r-cart">
			<a href = "<?=Yii::app()->createUrl('/shop/cart/index')?>">
				<span>КОРЗИНА</span><img src = "/images/cart.png"/>
			</a>
		</li>
	</ul>
       
		<div class="mini">    
            <div class="navagation-wrapper">
                <select class="navagation">
                    <option value="" selected="selected">Главное меню</option>
                </select>
            </div>
		</div>	
	<?php 
	$cart = Yii::app()->shoppingCart;
	$style = '';
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
