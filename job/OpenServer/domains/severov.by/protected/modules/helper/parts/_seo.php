	<div class = "g-clear_fix"></div>
	<div class = "b-admin_seo j-admin_seo">
		<h2 class = "l-admin_seo_title"><?=Yii::t('admin', 'SEO block'); ?></h2>
		<div class = "b-admin_post_seo j-admin_post_seo">
			<div class="l-row">
				<?=$form->textFieldControlGroup($model, 'seo_title');?>
			</div>
			
			<div class="l-row">
				<?=$form->textAreaControlGroup($model, 'seo_description');?>
			</div>
			
			<div class="l-row">
				<?=$form->textAreaControlGroup($model, 'seo_keywords');?>
			</div>
	
			<div class="l-row">
				<?=$form->textFieldControlGroup($model, 'url');?>
			</div>
		</div>
	</div>
<?php JS::add('seoInit', 'seoInit("'.Yii::t('admin', 'Show').'", "'.Yii::t('admin', 'Hide').'", "btn btn-default btn-sm");', 0);?>
