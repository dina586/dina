<?php $this->seo('Checkout');
Yii::app()->clientScript->registerPackage('mask');
JS::add('mobilemask', '$(".j-mobile_field").mask("(999) 999-9999");');
?>

<div class = "j-shopping_cart b-shopping_cart">
	<h1 class = "l-page_title"><?=$this->pageTitle;?></h1>
	<div class = "g-clear_fix"></div>
	
	<?php if(Yii::app()->user->hasFlash('cart')): ?>
	
		<div class="l-system_message">
			<?php echo Yii::app()->user->getFlash('cart'); ?>
		</div>
		
	<?php elseif($position = Yii::app()->shoppingCart->isEmpty(1) == true):?>
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
				<td class = "l-nowrap">$ <?=StoreHelper::viewPrice($view->getPrice())?></td>
				<td class = "l-nowrap">$ <?=StoreHelper::viewPrice($view->getSumPrice());?></td>

			</tr>
		<?php }	?>
			</tbody>
			<tfoot>
				<tr>
				<td colspan="4" class = "l-align_right">Total</td>
				<td colspan="2"><span class = "l-nowrap">$ <?=StoreHelper::viewPrice(Yii::app()->shoppingCart->getCost());?></span></td>
				</tr>
			</tfoot>
		</table>
		</div>
		<div class = "g-clear_fix"></div>
		
		<div class = "l-form j-order_form">
			<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
				'id'=>'b-'.Yii::app()->controller->module->id.'-form',
				'enableAjaxValidation'=>false,
			)); ?>
			
			<?php echo $form->errorSummary($order); ?>
							
				<div class="l-row">
					<div class = "col-md-6">
						<?php echo $form->textFieldControlGroup($order,'firstname'); ?>
					</div>
					
					<div class = "col-md-6">
						<?php echo $form->textFieldControlGroup($order,'lastname'); ?>
					</div>
				</div>
				
				<div class = "l-row">
					<div class="col-md-12">
						<?php echo $form->textFieldControlGroup($order,'address'); ?>
						<p class = "l-hint">Example: 1010 Beadnell Way Apt 1010</p>
					</div>
				</div>
				
				<div class="l-row">
					<div class = "col-md-6">
						<?php echo $form->textFieldControlGroup($order,'city'); ?>
					</div>
					
					<div class = "col-md-6">
						<?php echo $form->dropDownListControlGroup(
								$order,
								'state',
								CHtml::listData(UsaStates::model()->findAll(array('order'=>'state_name')), 'state_abbreviation', 'state_name'),
								array('empty'=>Yii::t('user', 'Choose State'))
						);?>
					</div>
				</div>
				
				<div class="l-row">
					<div class = "col-md-6">
						<?php echo $form->textFieldControlGroup($order,'zip'); ?>
					</div>
					
					<div class = "col-md-6">
						<?php echo $form->textFieldControlGroup($order,'country'); ?>
					</div>
					
				</div>
				
				
				<div class = "g-clear_fix"></div>
				
				<div class="l-row">
					
					<div class = "col-md-6">
						<?php echo $form->textFieldControlGroup($order,'email'); ?>
					</div>
					
					<div class = "col-md-6">
						<?php echo $form->textFieldControlGroup($order,'phone', array('class'=>'j-mobile_field')); ?>
					</div>
				</div>
				
				<?php if($order->international == 0) {
						$usClass = "g-visible";
						$intClass = "g-hidden";
					}
					else {
						$usClass = "g-hidden";
						$intClass = "g-visible";
					}
				?>
				
				<div class = "b-shopping_cart_purchase">						
					
					<div class="l-checkbox j-cart_international">
						<?=$form->checkBoxControlGroup($order, 'international', array('value' => '1', 'uncheckValue'=>'0'));?>
					</div>
					
					<div class = "g-clear_fix"></div>
					
					<div class="l-row j-cart_us <?=$usClass?>">
						<div class="col-md-12">
							<?=$form->dropDownListControlGroup($order, 'us_shipping', 
								CHtml::listData(StoreDelivery::model()->findAll(array('order'=>'name')), 'us_shipping', 'name'
							), array('empty'=>'Choose Shipping'));?>
						</div>
					</div>
					
					<div class="l-row j-cart_internation <?=$intClass?>">
						<div class="col-md-12">
							<?=$form->dropDownListControlGroup($order, 'int_shipping', 
								CHtml::listData(StoreDelivery::model()->findAll(array('order'=>'name')), 'int_shipping', 'name'
							), array('empty'=>'Choose Shipping'));?>
						</div>
					</div>
					
					<p>Shipping Cost: $ <span class = "j-shipping_price"></span></p>
				
				</div>	
				
				<div class="l-row">
					<div class="col-md-12">
						<?php echo $form->textAreaControlGroup($order,'comment'); ?>
					</div>
				</div>
				
				<div class = "g-clear_fix"></div>
					
				<?=Fields::submitBtn( Yii::t('main','Proceed'), BsHtml::GLYPHICON_ENVELOPE);?>
				
			<?php $this->endWidget(); ?>
		</div>
       
		
	<?php endif; ?>
</div>
