<div class="g-content">
	<div class="l-base_wraper b-portfolio_view">
		<section class = "l-page_title_wrap">
			<h1 class = "l-page_title"><?=$model->name; ?></h1>
		</section>
		<?php $tags = explode(", ", $model->tags);?>
		<div class = "widget widget_tag_cloud">
			<div class="tagcloud">
				<?php foreach($tags as $tag ){?>				
					<?=CHtml::link(CHtml::encode($tag), array('view/tags','tag'=>$tag, 'type'=>$model->radiobutton==1?'video':'photo'));?>				
				<?php }?>							
			</div>
		</div>
		
		<div class = "clearfix"></div>

		<?php $this->widget('application.modules.portfolio.widgets.BeautyGalleryWidget', array('id' => $model->id)); ?>

		<div class = "clearfix"></div>

		<div class = "content-section">
			<?=$model->content; ?>
		</div>

		<div class = "clearfix"></div>
		
		<?php $this->widget('application.modules.portfolio.widgets.GalleryWidget', array('id' => $model->id, 'cover'=>$model->radiobutton==1?false:true)); ?>

	</div>
	
</div>
<div class ="clearfix"></div>

<?=Helper::editLink(Yii::app()->createUrl(Yii::app()->controller->module->id.'/'.Yii::app()->controller->id.'/update', array('id' => $model->id))); ?>