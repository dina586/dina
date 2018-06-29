<?php if (DEV_MODE): ?>
	<div class =" block full">
		<p><?= $error['message'] ?></p>
		<p><?= $error['file'] ?> on line <?= $error['line'] ?></p>
		<p class = "text-left"><?= str_replace('#', '<br/>', $error['trace']) ?></p>
	</div>
<?php endif; ?>