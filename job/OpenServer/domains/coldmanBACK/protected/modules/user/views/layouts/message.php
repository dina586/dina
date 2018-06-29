<?php if($json['error'] === false): ?>
	<div class="alert alert-success">
		<p><i class="fa fa-check"></i> <?=$json['message']; ?></p>
	</div>
<?php else: ?>
	<div class="alert alert-danger">
		<p><i class="fa fa-times-circle"></i> <?=$json['message'] ?></p>
	</div>
<?php endif;
