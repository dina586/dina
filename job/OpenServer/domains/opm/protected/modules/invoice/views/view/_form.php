<?php 
$total = $model->total_cost + $model->tax + $model->shipping;
if($total<0)
	$total = 0;

Yii::app()->clientScript->registerPackage('invoice_module');
JS::add('mobilemask', '$(".j-phone_field").mask("(999) 999-9999");');
?>
<div class = "b-invoice_form l-form">

	<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
		'id'=>'b-'.Yii::app()->controller->module->id.'-form',
		'enableAjaxValidation'=>false,
		'htmlOptions'=>array('enctype'=>'multipart/form-data', 'class'=>'form-horizontal'),
	)); ?>
	
	<?php echo $form->errorSummary($model); ?>
	
	<header class = "b-invoice_header">
		<div class = "col-md-4">
			<div class="panel panel-primary">
				<div class="panel-heading ui-draggable-handle">
					<h3 class="panel-title">Organic Permanent Makeup</h3>
				</div>
				<div class="panel-body">
					<p>12113 Santa Monica, Suite 203,</p>
					<p>Los Angeles, CA 90025</p>
					<p><?=trim(Settings::getVal('phone'), '+1 '); ?></p>
					<p><a href="mailto:opmakeup@gmail.com">opmakeup@gmail.com</a></p>
				</div>
			</div>
			
			<div class = "g-clear_fix"></div>
			
			<div class = "form_group">
				<a target = "_blank" class="btn btn-success btn-block" href="<?=Yii::app()->createUrl('user/admin/create')?>">
					<span class="fa fa-plus"></span> Add new customer
				</a>
			</div>
			
			<div class = "form_group">
				<?=Fields::dateTimeFieldOld($model, $form, 'create_date')?>
			</div>
			<div class = "form_group">
				<?=Fields::dateTimeFieldOld($model, $form, 'due_date', false, 'date')?>
			</div>
		</div>
		
		<div class = "col-md-8">
					
			<div class = "form-group b-invoice_type">
				<?=$form->labelEx($model, 'invoice_type', array('class'=>'control-label'));?>
				<div class = "input-group">
					<?=$form->dropDownList($model, 'invoice_type', $this->module->type, array('class'=>'form-control j-invoice_type'))?>
					<span class="input-group-addon"><i class="fa fa-folder"></i></span>
				</div>
			</div>
			
			<?php $style = $model->invoice_type==0?'style = "display:block;"':''?>
			
			<div class = "form-group j-invoice_name" <?=$style?>>
				<div class = "input-group">
					<?=$form->textField($model, 'invoice_name', array('class'=>'form-control', 'placeholder'=>Yii::t('user','Invoice name')))?>
					<span class="input-group-addon"><i class="fa fa fa-reply"></i></span>
				</div>
			</div>
			
			<div class = "form-group">
				<div class = "input-group">
				<?php 
					$this->widget('CAutoComplete', array(
						'model'=>$model,
							'attribute'=>'name',
							//'autoFill'=>true,
							//'options'=>array('extraParams'=>'c: function() { return $("#test").val(); } '),
							'url'=>Yii::app()->createUrl('invoice/view/getUser'),
							'htmlOptions'=>array('placeholder'=>Yii::t('user','Choose a customer'), 'class'=>'form-control a-get_user'),
							));
						?>
					<span class="input-group-addon"><i class="fa fa-user"></i></span>
				</div>
			</div>
			
			<div class = "form-group">
				<div class = "input-group">
					<?=$form->textField($model, 'email', array('class'=>'form-control'))?>
					<span class="input-group-addon"><i class="fa fa-envelope"></i></span>
				</div>
			</div>
				
			<div class = "form-group">
				<div class = "input-group">
					<?=$form->textField($model, 'phone', array('class'=>'j-phone_field form-control'))?>
					<span class="input-group-addon"><i class="fa fa-phone"></i></span>
				</div>
			</div>
				
			<div class = "form-group b-invoice_address">
				<?=$form->textArea($model, 'address', array('class'=>'form-control', 'placeholder'=>'Customer address'))?>
			</div>
				
			<div class = "form-group">
				<div class = "input-group">
					<?=$form->dropDownList($model, 'status', $this->module->status)?>
					<span class="input-group-addon"><i class="fa fa-bars"></i></span>
				</div>
			</div>
				
			<?=$form->hiddenField($model, 'user_id')?>
		</div>

	</header>
	
	<div class = "g-clear_fix"></div>
	
	<div class = "b-invoice_body">
		<table class = "b-invoice_table j-invoice_table table table-bordered">
			<thead>
				<tr>
					<th class = "invoice_tbl_description">ACTIVITY</th>
					<th>QTY</th>
					<th  class = "invoice_tbl_total">Price</th>
					<th class = "invoice_tbl_total">AMOUNT</th>
					<th class = "tbl_header_btns_column"></th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$items = unserialize($model->invoice_data);
					$subtotal = 0;
					$number = 0;
					
					if(!empty($items)):
						foreach($items as $i => $v) {
							if(trim($items[$i][1]) == '')
								continue;
							
							echo '<tr class = "j-btn_row" data-type="'.$i.'">';
								echo '<td>'.BsHtml::textField('invoice['.$i.'][1]', $items[$i][1]).'</td>';
								
								for($j = 2; $j < 4; $j++) {
									if($j == 2)
										echo  '<td>'
											.BsHtml::numberField('invoice['.$i.']['.$j.']', $items[$i][$j], array('class'=>'k-unit_input j-number_int form-control')).
										'</td>';
									else
										echo  '<td  class = "invoice_price_row">
											<div class = "input-group">'
											.BsHtml::textField('invoice['.$i.']['.$j.']', $items[$i][$j], array('class'=>'k-unit_input j-number_float form-control')).
										'<span class="input-group-addon">$</span>
										</div></td>';
								}
																						
								$subtotal += $items[$i][2] * $items[$i][3];
								echo '<td class = "invoice_tbl_total">
									$ <span class = "j-invoice_total_row">'.Helper::viewPrice($items[$i][4]).'</span>
									'.BsHtml::hiddenField('invoice['.$i.'][4]', $items[$i][4], array('class'=>'j-invoice_total_row_input form-control')).'
								</td>';
								echo '<td class = "b-table_btns j-table_btns">
									<a href = "#" class = "table_btn_clone j-clone">+</a>
									<a href = "#" class = "table_btn_remove j-remove">-</a>
								</td>';
							echo '</tr>';
							$number++;
						} 
					endif;
					
					$i = $number==0?1:$number+1;
					
					//Догенерируем пустых строк для вывода
					echo '<tr class = "j-btn_row" data-type="'.$i.'">';
						echo '<td>'.BsHtml::textField('invoice['.$i.'][1]', '').'</td>';
						for($j = 2; $j < 4; $j++) {
							if($j == 2) 
								echo  '<td>'.BsHtml::numberField('invoice['.$i.']['.$j.']', 0, array('class'=>'k-unit_input j-number_int form-control')).'</td>';
							else 
								echo  '<td class = "invoice_price_row">
										<div class = "input-group">
											'.BsHtml::textField('invoice['.$i.']['.$j.']', Helper::viewPrice(0), array('class'=>'k-unit_input j-number_float form-control')).'
											<span class="input-group-addon">$</span>
										</div>
									</td>';
						}
						echo '<td class = "invoice_tbl_total">
								$ <span class = "j-invoice_total_row">'.Helper::viewPrice(0).'</span>
								'.BsHtml::hiddenField('invoice['.$i.'][4]', Helper::viewPrice(0), array('class'=>'j-invoice_total_row_input form-control')).'
							</td>';
						echo '<td class = "b-table_btns j-table_btns">
								<a href = "#" class = "table_btn_clone j-clone">+</a>
								<a href = "#" class = "table_btn_remove j-remove">-</a>
							</td>';
					echo '</tr>';
					$i++;
					
				?>
			</tbody>
				
			<tfoot>
				<tr>
					<td colspan = "3" class = "l-align_right">
						<b>SUBTOTAL:</b>
					</td>
					<td class = "l-align_right">$ <span class = "j-invoice_subtotal"><?=Helper::viewPrice($subtotal);?></span></td>
					<td></td>
				</tr>
				<tr>
					<td colspan = "3" class = "l-align_right">
						<b>DISCOUNT:</b>
					</td>
					<td class = "l-align_right l-no_label">
						<?=$form->textField($model, 'discount', array('class'=>"j-invoice_discount form-control"));?>
					</td>
					<td></td>
				</tr>
				<tr>
					<td colspan = "3" class = "l-align_right">
						<b>TAX (<span class = "j-invoice_tax_percent" data-default = "<?=Settings::getVal('tax');?>"><?=$model->tax_percent;?></span>%):</b>
					</td>
					<td class = "l-align_right">$ <span class = "j-invoice_tax"><?=Helper::viewPrice($model->tax);?></span></td>
					<td>
						<?=$form->hiddenField($model, 'tax', array('class'=>'j-invoice_tax_input form-control'))?>
					</td>
				</tr>
				
				<tr>
					<td colspan = "3" class = "l-align_right">
						<b>SHIPPING:</b>
					</td>
					<td class = "l-align_right l-no_label">
						<?=$form->textField($model, 'shipping', array('class'=>"j-invoice_shipping form-control"));?>
					</td>
					<td></td>
				</tr>
				
				<tr>
					<td colspan = "3" class = "l-align_right">
						<b>DEPOSIT:</b>
					</td>
					<td class = "l-align_right l-no_label">
						<?=$form->textField($model, 'deposit', array('class'=>"j-invoice_deposit form-control"));?>
					</td>
					<td></td>
				</tr>
				
				<tr>
					<td colspan = "3" class = "l-align_right">
						<b>PAYMENT:</b>
					</td>
					<td class = "l-align_right l-no_label">
						$ <span class = "j-invoice_payment"><?=InvoiceHelper::getPayment($subtotal, $model);?></span>
					</td>
					<td></td>
				</tr>
				
				<tr class = "total_due">
					<td colspan = "3" class = "l-align_right">
						<b>TOTAL DUE:</b>
					</td>
					<td class = "l-align_right l-no_label">
						$ <span class = "j-invoice_total"><?=Helper::viewPrice($model->total_cost);?></span>
					</td>
					<td>	
						<?=$form->hiddenField($model, 'total_cost', array('class'=>'j-invoice_total_input'))?>
					</td>
				</tr>
			</tfoot>
		</table>
	</div>
	
	<div class = "g-clear_fix"></div>
	
	<div class = "l-button_wrap">
		<?=Fields::submitBtn($model->isNewRecord ? Yii::t('admin','Create') : Yii::t('admin','Save'));?>
		<?=Fields::submitBtn('Save And Print', BsHtml::GLYPHICON_PRINT);?>
		<?=Fields::submitBtn('Save And PAY', BsHtml::GLYPHICON_USD);?>
	 </div>
	<?php $this->endWidget(); ?>
</div>		
