<div class="block full b-toggle_seo">
	<div class="block-title">
		<h2><strong>SEO</strong> Block</h2>
	</div>
	<div class ="block-content">
		
		<a href ="#" class ="j-show_seo btn btn-block btn-primary">
			<i class="fa fa-arrow-circle-down"></i>
			<?=Yii::t('admin', 'Show');?>
		</a>
		
		<div class ="j-seo_block l-hidden row">
			<div class = "col-md-6">

				<div class="l-row">
					<?= $form->textFieldControlGroup($model, 'title'); ?>
				</div>

				<div class="l-row">
					<?= $form->textAreaControlGroup($model, 'description'); ?>
				</div>

			</div>

			<div class = "col-md-6">

				<div class="l-row">
					<?= $form->textFieldControlGroup($model, 'url'); ?>
				</div>

				<div class="l-row">
					<?= $form->textAreaControlGroup($model, 'keywords'); ?>
				</div>
			</div>
		</div>

	</div>
	
	<div class ="clearfix"></div>
	
	<a href ="#" class ="j-hide_seo btn btn-block btn-primary l-hidden">
		<i class="fa fa-arrow-circle-up"></i>
		<?=Yii::t('admin', 'Hide');?>
	</a>
</div>