<?php $this->beginContent('//layouts/site'); ?>
	
    <div class="col-md-8">
        <?php echo $content; ?>
    </div>
    
    <div class="col-md-4">
		<?php $this->renderPartial('//layouts/parts/_content')?>
    </div>

<?php $this->endContent(); ?>