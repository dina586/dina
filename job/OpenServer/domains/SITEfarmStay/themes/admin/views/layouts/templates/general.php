<?php $this->beginContent('//layouts/templates/admin'); ?>
<div class="content-header">
	<div class="header-section">
		<h1>
			<i class="gi gi-cogwheels"></i><?=Settings::getVal('site_name');?></small>
		</h1>
	</div>
</div>

<div class ="clearfix"></div>
	<?php echo $content; ?>
<div class ="clearfix"></div>

<?php $this->endContent(); ?>