<div class="col-md-6">
	<div class="block last_no_border">

		<div class="block-title">
			<h2>General Information</h2>
		</div>

		<?php
		echo $form->textFieldControlGroup($model, 'email', array(
			'append' => '<i class="gi gi-envelope"></i>',
		));
		?>

		<?php
		echo $form->textFieldControlGroup($model, 'login', array(
			'append' => '<i class="fa fa-user"></i>',
		));
		?>
		<?php
		echo $form->textFieldControlGroup($profile, 'firstname', array(
			'append' => '<i class="gi gi-user"></i>',
		));
		?>
		<?php
		echo $form->textFieldControlGroup($profile, 'lastname', array(
			'append' => '<i class="gi gi-user"></i>',
		));
		?>

	</div>
</div>