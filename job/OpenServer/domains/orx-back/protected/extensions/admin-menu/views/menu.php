<?php Yii::import('application.modules.shop.models.Comment');
$number = Comment::model()->count('is_new=1');
if($number>0) 
	$col = ' ('.$number.')';
else 
	$col = '';
?>
<style>
	#ext_admin_menu {
		width: <? echo $this->width;?>;
	}
</style>
<div class = "b-ext_admin_menu_wrap">
	<ul id="ext_admin_menu">
		<li>
			<a href = "<?=Yii::app()->createUrl('/shop/product/admin')?>">Товары</a>
			<ul>
				<li><a href = "<?=Yii::app()->createUrl('/shop/product/admin')?>">Управление</a></li>
				<li><a href = "<?=Yii::app()->createUrl('/shop/product/create')?>">Добавить</a></li>
				<li><a href = "<?=Yii::app()->createUrl('/helper/default/index')?>">Эксель</a></li>
				<li><a href = "<?=Yii::app()->createUrl('search/create')?>">Индексация</a></li>
				<li><a href = "<?=Yii::app()->createUrl('stock/default/admin')?>">Акции</a></li>
			</ul>
		</li>
		<li>
			<a href = "<?=Yii::app()->createUrl('/shop/catalog/admin')?>">Каталог</a>
			<ul>
				<li><a href = "<?=Yii::app()->createUrl('/shop/catalog/admin')?>">Управление</a></li>
				<li><a href = "<?=Yii::app()->createUrl('/shop/catalog/create')?>">Добавить</a></li>
			</ul>
		</li>
		<li>
			<a href = "<?=Yii::app()->createUrl('opinions/admin')?>">Отзывы</a>
		</li>
		<li>
			<a href = "<?=Yii::app()->createUrl('/about/admin')?>">Статьи</a>
			<ul>
				<li><a href = "<?=Yii::app()->createUrl('/about/admin')?>">Управление</a></li>
				<li><a href = "<?=Yii::app()->createUrl('/about/create')?>">Добавить</a></li>
			</ul>
		</li>
		<li>
			<a href = "<?=Yii::app()->createUrl('/gallery/default/create')?>">Фото</a>
		</li>
		<li>
			<a href = "<?=Yii::app()->createUrl('/block/default/admin')?>">Блоки</a>
			<ul>
				<li><a href = "<?=Yii::app()->createUrl('/block/default/admin')?>">Управление</a></li>
				<li><a href = "<?=Yii::app()->createUrl('/block/default/create')?>">Добавить</a></li>
			</ul>
		</li>
		<li>
			<a href = "<?=Yii::app()->createUrl('/content/default/admin')?>">Статическая информация</a>
		</li>
		<li>
			<a href = "<?=Yii::app()->createUrl('/email/default/admin')?>">Email</a>
			<ul>
				<li><a href = "<?=Yii::app()->createUrl('/email/default/admin')?>">Управление</a></li>
				<li><a href = "<?=Yii::app()->createUrl('/email/default/create')?>">Добавить</a></li>
			</ul>
		</li>
		<li>
			<a href = "<?=Yii::app()->createUrl('/clients/default/admin')?>">Клиенты</a>
		</li>
		<li>
			<a href = "<?=Yii::app()->createUrl('shop/comment/admin')?>">Комментарии<?=$col?></a>
		</li>
		
		<li>
			<a href = "<?=Yii::app()->createUrl('/site/logout')?>">Выход</a>
		</li>
	</ul> 
</div>