<?php $this->beginContent('//layouts/main'); ?>
	
    <div class="clear"></div>
	
    <div class="g-content">
        <?php echo $content; ?>
        <div class="clear"></div>
    </div>
	
    <?php $this->endContent(); ?>

<?php JS::add('cancelCopy', 'cancelCopy()')?>