<?php $this->beginContent('//layouts/templates/admin_main'); ?>
<div class="content-header">
	<div class="header-section">
		<h1>
			<i class="fa fa-hand-o-left"></i> <?= $this->pageTitle ?>
		</h1>
	</div>
</div>
<!--
<ul class="breadcrumb breadcrumb-top">
	<li>Tables</li>
	<li><a href="">Responsive</a></li>
</ul>
-->

<div class ="clearfix"></div>
<?php echo $content; ?>
<div class ="clearfix"></div>

<?php $this->endContent(); ?>