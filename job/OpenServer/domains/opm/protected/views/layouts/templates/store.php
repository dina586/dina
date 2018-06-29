<?php $this->beginContent('//layouts/site'); ?>

	<div class = "c-store_left">
		<?php $this->renderPartial('//layouts/parts/_store_catalog')?>
    </div>
   
    <div class = "c-store_right">
		<?php echo $content; ?>
	</div>

<?php $this->endContent(); ?>