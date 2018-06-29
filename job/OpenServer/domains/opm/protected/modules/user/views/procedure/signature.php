<div class = "g-clear_fix"></div>
<div class = "l-form">
	<div class = "b-signature" id="signature"></div>
	
	<div class = "b-signature_bnts">
		<div class = "col-md-4">
			<a href="#" class="btn btn-danger j-signature_save"><span class="glyphicon glyphicon-save"></span> Save</a>
		</div>
		<div class = "col-md-4">
			<a href="#" class="btn btn-success j-signature_clear"><span class="glyphicon glyphicon-refresh"></span> Clear</a>
		</div>
	</div>
	<div class = "g-clear_fix"></div>
	<?php if($model->signature!=''){?>
		<div class = "col-md-4 b-signature_image j-signature_view"><img src="data:<?=$model->signature?>"/></div>
	<?php }?>

	<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
		'id'=>'a-signature_form',
	)); ?>
		<?php echo $form->hiddenField($model,'signature', array('class'=>'d-signature')); ?>
	<?php $this->endWidget(); ?>
	
</div>

<script>
	
	$(document).ready(function() {
		$("#signature").jSignature({});

	})
	
	$(document).on('click', '.j-signature_clear', function() {
		$("#signature").jSignature('clear');
		return false;
	})
	
	$(document).on('click', '.j-signature_save', function() {
		var data = $("#signature").jSignature('getData', 'image');
		$('.d-signature').val(data);
		$('#a-signature_form').submit();
	})
</script>