<?php $this->beginContent('//layouts/main'); ?>
	<div class = "g-clear_fix"></div>
	<div class = "b-admin">
		<h1 class = "l-admin_title"><?=$this->pageTitle;?></h1>
		<?php echo $content; ?>
		<div class = "g-clear_fix"></div>
	</div>
<?php $this->endContent(); ?>