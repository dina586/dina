<aside class = "l-left c-left">
	<section class = "b-left_catalog">
		<h2>Catalog</h2>
		<?php
			$store = new StoreHelper();
			echo $store->viewMenu();
		?>
	</section>
</aside>