<div class = "g-clear_fix"></div>

<div class="col-md-6">
	<!-- START MODAL SIZES -->
	<div class="panel panel-default">
		
		<div class="panel-heading ui-draggable-handle">
			<h3 class="panel-title">Payment stats</h3>
		</div>
		
		<div class="panel-body">
			<ul class ="panel-body list-group border-bottom">
				<li class = "list-group-item">
					Total: $ <?=Invoice::model()->invoiceTotalSum($model);?>
				</li>
				<li class = "list-group-item">
					Paid: $ <?=Invoice::model()->invoiceTotalSum($model, 1);?>
				</li>
				<li class = "list-group-item">
					Unpaid: $ <?=Invoice::model()->invoiceTotalSum($model, 0);?>
				</li>
			</ul>

		</div>
	</div>
	<!-- END MODAL SIZES -->
</div>

<div class="col-md-6">
	<!-- START MODAL SIZES -->
	<div class="panel panel-default">
		
		<div class="panel-heading ui-draggable-handle">
			<h3 class="panel-title">Invoice number</h3>
		</div>
		
		<div class="panel-body">
			<ul class ="panel-body list-group border-bottom">
				<li class = "list-group-item">
					Total: <?=Invoice::model()->invoiceCount($model);?>
				</li>
				<li class = "list-group-item">
					Paid: <?=Invoice::model()->invoiceCount($model, 1);?>
				</li>
				<li class = "list-group-item">
					Unpaid: <?=Invoice::model()->invoiceCount($model, 0);?>
				</li>
			</ul>

		</div>
	</div>
	<!-- END MODAL SIZES -->
</div>

<div class = "g-clear_fix"></div>

<div class = "block b-invoice_filter a-invoice_filter">
	<div class = "col-md-12 ">
	
		<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
			'id'=>'b-'.Yii::app()->controller->module->id.'-form',
			'enableAjaxValidation'=>false,
			'method'=>'get',
			'action'=>Yii::app()->createUrl($this->route),
			'layout' => BsHtml::FORM_LAYOUT_HORIZONTAL,
			'htmlOptions'=>array('enctype'=>'multipart/form-data', 'class'=>'form-horizontal'),
		)); ?>
		
		<div class = "col-md-3">
			<div class="input-group">                                            
	            <span class="input-group-addon"><i class="fa fa-folder"></i></span>
				<?=$form->dropDownList($model, 'invoice_type', Yii::app()->getModule('invoice')->type, array('empty'=>'Choose invoice type'));?>
			</div>
		</div>
		
		<?php 
		$invoiceStatus = array_merge(Yii::app()->getModule('invoice')->status, array(100=>'Back payment'));
		?>
		
		<div class = "col-md-3">
			<div class="input-group">                                            
	            <span class="input-group-addon">$</span>
				<?=$form->dropDownList($model, 'status', $invoiceStatus, array('empty'=>'Choose invoice payment'));?>
			</div>
		</div>
		
		<div class = "col-md-3">
			<div class="input-group">                                            
	            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
	            
	            <?php Yii::app()->controller->widget('zii.widgets.jui.CJuiDatePicker', array(
						'model'=>$model,
						'attribute'=> 'start_date',
						'options'=>array(
							'showAnim'=>'fold',
							'constrainInput'=> true,
							'changeMonth'=> true,
							'changeYear'=> true,
							'yearRange' => '2014:'.date('Y'),
						),
						'htmlOptions'=>array('placeholder'=>Yii::t('main', 'Start Date'), 'class'=>'form-control')
					));
				?>
			</div>
		</div>
		
		<div class = "col-md-3">
			<div class="input-group">                                            
	            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
	            
	            <?php Yii::app()->controller->widget('zii.widgets.jui.CJuiDatePicker', array(
						'model'=>$model,
						'attribute'=> 'end_date',
						'options'=>array(
							'showAnim'=>'fold',
							'constrainInput'=> true,
							'changeMonth'=> true,
							'changeYear'=> true,
							'yearRange' => '2014:'.date('Y'),
						),
						'htmlOptions'=>array('placeholder'=>Yii::t('main', 'End Date'), 'class'=>'form-control')
					));
				?>
			</div>
		</div>
		<div class = "g-clear_fix"></div>
		
		<div class = "b-invoice_filter_row">
			<div class = "col-md-3 pull-right">
				<?=Fields::submitBtn('Search', BsHtml::GLYPHICON_SEARCH);?>
			</div>
		</div>
		
		<?php $this->endWidget(); ?>
	</div>
</div>

<div class = "g-clear_fix"></div>

<?php
Yii::app()->clientScript->registerScript('search', "
	$('.search-button').click(function(){
		$('.search-form').toggle();
		return false;
	});
$('.a-invoice_filter form select').submit(function(){
	$('#content-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
