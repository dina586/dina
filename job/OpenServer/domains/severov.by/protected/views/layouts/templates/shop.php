<?php $this->beginContent('//layouts/main'); ?>

<?php $this->renderPartial('//layouts/parts/_header'); ?>

<div class = "g-container g-site_width">
	

	<div class = "g-clear_fix"></div>
	
	<div class = "g-content">
		<?php 
		if(Yii::app()->controller->id != 'search')
			$class = ' d-content';
		else
			$class = '';
		?>
		<aside class = "c-left">
		</aside>
		<aside class = "c-right <?=$class?>">
			<?php echo $content; ?>
		</aside>
		<div class = "g-clear_fix"></div>
	</div>
	
	<?php $this->renderPartial('//layouts/parts/_footer'); ?>
</div>
<?php $this->endContent(); ?>