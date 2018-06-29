<?php $term = CHtml::encode($term);
	$this->seo('Search results for '. $term);
?>
<h1 class = "l-page_title">Search results for: "<b><?php echo $term; ?></b>"</h1>

<div class = "l-page_wrapper">

	<div class = "b-search_results">
	<section class = "g-styles b-main_search">
		<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
			'id'=>'search-form',
			'action'=>Yii::app()->createUrl($this->route),
			'method'=>'get',
		)); ?>
		
		<div class = "col-md-10">
		
			<?php echo $form->textFieldControlGroup($search,'term', array('class'=>'search_field l-no_label')); ?>
		
		</div>
		
		<div class = "col-md-2">
			<?=Fields::submitBtn( Yii::t('main','Search'), BsHtml::GLYPHICON_SEARCH);?>
		</div>
		
		<div class = "g-clear_fix"></div>
			
		<?php $this->endWidget(); ?>
	</section>


	</div>
	<?php 
		if(strlen($term)>= 3):
	
	?>
	
	<?php 
		if(count($dataProvider)>0):
			foreach($dataProvider as $data) {
				
				$viewText = $this->sentenceCut(strip_tags($data->content), $term, 3);

				echo '
				<section class = "b-search_term">
				<article><div class="b-image-search">'.Helper::getCover($data->id, Yii::app()->getModule('store')->folder, Yii::app()->createUrl('/store/product/view', array('url'=>$data->url)), "thumbnail").'</div>
					<p class = "j-search_highlight b-search_name"><a href = "/store/product/'.$data->url.'">'.$data->name.'</a></p>
					<p class = "j-search_highlight">
						'.$viewText.'
					</p>
					</article>
			</section>';
			}
		endif;
	?>
	
<?php 
$this->widget('BsPager', array(
    'pages' => $pages,
))?>
	<script type = "text/javascript">
$(document).ready(function() {
	$('.j-search_highlight').highlight('<?php echo $term; ?>');
})
</script>
	

	<?php else: ?>
		<p class="error">The query must consist of more than 3 characters</p>
	<?php endif; ?>
</div>




