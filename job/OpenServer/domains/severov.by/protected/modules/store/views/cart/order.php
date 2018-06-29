<?php $this->seo('Оформление заказа');?>
<div class = "j-shopping_cart b-shopping_cart">
	<h1 class = "l-page_title"><?=$this->pageTitle;?></h1>
	<div class = "g-clear_fix"></div>
	
	<?php if(Yii::app()->user->hasFlash('cart')): ?>
	
		<div class="l-system_message">
			<?php echo Yii::app()->user->getFlash('cart'); ?>
		</div>
		
	<?php elseif($position = Yii::app()->shoppingCart->isEmpty(1) == true):?>
		<article class = "b-transit">
			<p>Ваша корзина пуста! Посетите магазин!</p>
		</article>
	<?php else : ?>
		<table class = "d-cart_table">
			<thead>
			<tr>
				<th></th>
				<th>Название</th>
				<th>Кол-во</th>
				<th>Цена за единицу</th>
				<th>Всего</th>
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
		?>
			<tr>
				<td><?=$imageLink;?></td>
				<td><?=$nameLink;?></td>
				<td>
					<?=$view->getQuantity();?>
				</td>
				<td class = "l-nowrap"><?=number_format($view->getPrice(), 0, '', ' ')?></td>
				<td class = "l-nowrap"><?=number_format($view->getSumPrice(), 0, '', ' ');?></td>

			</tr>
		<?php }	?>
			</tbody>
			<tfoot>
				<td colspan="4" class = "l-align_right">Всего</td>
				<td colspan="2"><span class = "l-nowrap"><?=number_format(Yii::app()->shoppingCart->getCost(), 0, '', ' ');?></span></td>
			</tfoot>
		</table>
		
		<div class = "g-clear_fix"></div>
		
		<div class = "b-cart_tabs j-cart_tabs">
			<?php
				echo BsHtml::tabs(array(
					array(
					'label' => 'Физическое лицо',
					'url' => '#',
					'active' => true
				),
				array(
					'label' => 'Юридическое лицо',
					'url' => '#'
				),
			));
			?>
		</div>

		<div class = "l-form j-order_form">
			<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
				'id'=>'b-'.Yii::app()->controller->module->id.'-form',
				'enableAjaxValidation'=>false,
			)); ?>
			
				<p class = "l-note"><?=Yii::t('admin', 'Fields with <span class="required">*</span> are required')?></p>
				
				<div class="l-row">
					<?php echo $form->textFieldControlGroup($order,'email'); ?>
				</div>
				
				<div class="l-row">
					<?php echo $form->textFieldControlGroup($order,'phone'); ?>
				</div>
				
				<div class="l-row">
					<?php echo $form->textFieldControlGroup($order,'name'); ?>
				</div>
				
				<div class="l-row">
					<?php echo $form->textAreaControlGroup($order,'comment'); ?>
				</div>
				
				<div class = "g-clear_fix"></div>
					
				<?=Fields::submitBtn( Yii::t('main','Send'), BsHtml::GLYPHICON_ENVELOPE);?>
				
			<?php $this->endWidget(); ?>
		</div>
		
		<div class = "l-form j-order_form" style = "display: none;">
			<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
				'id'=>'b-'.Yii::app()->controller->module->id.'-form',
				'enableAjaxValidation'=>false,
			)); ?>
			
				<p class = "l-note"><?=Yii::t('admin', 'Fields with <span class="required">*</span> are required')?></p>
				
				<div class="l-row">
					<?php echo $form->textFieldControlGroup($priv,'email'); ?>
				</div>
				
				<div class="l-row">
					<?php echo $form->textFieldControlGroup($priv,'phone'); ?>
				</div>
				
				<div class="l-row">
					<?php echo $form->textFieldControlGroup($priv,'name'); ?>
				</div>
				
				<div class="l-row">
					<?php echo $form->textFieldControlGroup($priv,'unp'); ?>
				</div>
				
				<div class="l-row">
					<?php echo $form->textFieldControlGroup($priv,'organization'); ?>
				</div>
				
				<div class="l-row">
					<?php echo $form->textFieldControlGroup($priv,'city'); ?>
				</div>
				
				<div class="l-row">
					<?php echo $form->textAreaControlGroup($priv,'comment'); ?>
				</div>
				
				<div class = "g-clear_fix"></div>
					
				<?=Fields::submitBtn( Yii::t('main','Send'), BsHtml::GLYPHICON_ENVELOPE);?>
				
			<?php $this->endWidget(); ?>
		</div>
		

       
		
	<?php endif; ?>
</div>
