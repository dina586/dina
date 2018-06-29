	<?php $this->beginContent('//layouts/main'); ?>
		<div class = "c-left_column">
			<?php echo $content; ?>
		</div>
		<?php $this->beginContent('//layouts/right_column'); ?>
		
		<?php $this->endContent(); ?>
	<?php $this->endContent(); ?>