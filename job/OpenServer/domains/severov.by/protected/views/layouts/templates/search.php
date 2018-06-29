<?php $this->beginContent('//layouts/main'); ?>
	

	
	<div class = "c-left">
		<?php $this->renderPartial('//layouts/parts/_left_column'); ?>
	</div>
	<div class = "c-right">
		<?php echo $content; ?>
	</div>
<?php $this->endContent(); ?>