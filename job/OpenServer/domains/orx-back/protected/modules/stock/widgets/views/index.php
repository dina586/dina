<!-- Акции -->
<div class = "g-stock">
	<div class = "g-stock_text l-inline_block">
		<?=$model->content; ?>
	</div>
	<?php
	$stockDate = $this->stockDate($model->date, $model->refresh);
	?>
	<div class = "g-stock_end l-inline_block">
		<div id="j-countdown" class = "b-countdown"></div>
	</div>
	<div class = "g-clear_fix"></div>
</div>
<script type ="text/javascript">
	stock_init(<?=$stockDate['year'];?>, <?=$stockDate['month'];?>, <?=$stockDate['day'];?>);
</script>