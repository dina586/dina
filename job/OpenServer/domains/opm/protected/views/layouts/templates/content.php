<?php $this->beginContent('//layouts/site'); ?>
	
    <div class="col-md-8 col-md-push-4">
        <?php echo $content; ?>
    </div>
    
    <div class="col-md-4 col-md-pull-8">
		<?php $this->renderPartial('//layouts/parts/_content')?>
    </div>

<?php $this->endContent(); ?>