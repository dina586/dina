<?php if(count($services >0)):?>
	<div class = "b-social_services">
		<h2><?=Yii::t('admin', 'Login via social network:');?></h2>
		
		<ul>
		  <?php
			foreach ($services as $name => $service) {?>
				<li class = "l-inline_block">
					<a href = "<?=Yii::app()->createUrl('/user/login', array('service'=>$name))?>">
						<img src = "/images/system/auth_icons/<?=strtolower($service->title)?>.png" alt = "<?=$service->title;?>"/>
						<span><?=$service->title?></span>
					</a>
				</li>
			<?php } ?>
		</ul>
	</div>
<?php endif;?>