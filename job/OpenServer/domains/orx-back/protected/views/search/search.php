<?php 
$viewTerm = $term;
$term = CHtml::encode($term);?>
<div class = "b-about">
<h3 class = "page_title">Результаты поиска для: <span>"<b><?php echo $term; ?></b>"</span></h3>
<div class = "l-material">
	<div class = "b-search">
		<form action = "<?php echo Yii::app()->createUrl('search/search');?>" method = "get">
			<input type = "text" name = "q" value = "<?=$viewTerm;?>" class = "search_field"/>
			<button class = "search_button">Найти</button>
			<div class = "g-clear_fix"></div>
		</form>
	</div>
<?php 
$pages = new CPagination(count($results));
$currentPage = Yii::app()->getRequest()->getQuery('page', 1);
$pages->pageSize = 10;

if (!empty($results)): 
	for($i = $currentPage * $pages->pageSize - $pages->pageSize, $end = $currentPage * $pages->pageSize; $i<$end;$i++):
		$text = $results[$i]->content;
		
		$viewText = $this->sentenceCut($results[$i]->content, $term);

		$url = Yii::app()->createUrl('shop/product/view', array('id'=>$results[$i]->prod_id));
		
		if(file_exists(ROOT_PATH.DIRECTORY_SEPARATOR.'upload'.DIRECTORY_SEPARATOR.'product'.DIRECTORY_SEPARATOR.$results[$i]->prod_id.DIRECTORY_SEPARATOR.'thumbnails'.DIRECTORY_SEPARATOR.$results[$i]->front_image) && $results[$i]->front_image != ''){
			$img = '<a href = "'.$url.'"><img src = "/upload/product/'.$results[$i]->prod_id.'/thumbnails/'.$results[$i]->front_image.'"/></a>';
		}
		else {
			$img = '<img src = "/images/no-img.png"/>';
		}
		
		if($viewText != '' || $results[$i]->name != '') {	
			echo '
				<section class = "b-opinion_view">
				'.$img.'
				<article>
					<p class = "j-search_highlight">'.$results[$i]->name.'</p>
					<p class = "j-search_highlight">
					'.$viewText.'
					</p>
					<p>'.$results[$i]->catalog.'</p>
					</article>
			</section>';
		} 
	endfor;
else: ?>
	<p class="error">Результат не найдены</p>
<?php endif; ?>
<div class = "g-clear_fix"></div>

	<?php $this->widget('CLinkPager', array(
	    'pages' => $pages,
	   	'header'=>false,
	)) ?>
	</div>
</div>
<script type = "text/javascript">
$(document).ready(function() {
	var term = '<?php echo $term; ?>';
    var words = term.split(' ');
	for(var i =0; i<words.length; i++) {
		$('.j-search_highlight').highlight(words[i]);
	}
})
</script>