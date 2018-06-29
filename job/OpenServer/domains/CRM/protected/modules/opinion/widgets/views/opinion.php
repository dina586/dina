<?php
if (count($dataProvider) > 0):
	?>
	<div class = "b-jcarousel_wrap b-opinion_carousel">
		<div class = "l-jcarousel j-jcarousel_opinion">
			<ul>
				<?php foreach ($dataProvider as $data) { 
						$description = preg_replace('/(<br \/>){2,}/', '<br />', $data->content);
						$path = Yii::getPathOfAlias('webroot').DS."upload".DS.Yii::app()->getModule('opinion')->folder.DS.$data->id.".jpg";
							if(file_exists($path))
								$img = '<div class = "b-opinion_img"><img src = "/upload/'.Yii::app()->getModule('opinion')->folder.'/'.$data->id.'.jpg" title = "'.$data->name.'" alt = "'.$data->name.'" /></div>';
							else
								$img = '';
					?>
					<li>
						<?=$img;?>
						<div class = "b-opinion_description">
							<p><b><?=$data->name?></b></p>
							<br/>
							<p><?=$description;?></p>
						</div>
					</li>
				<?php } ?> 
			</ul>
		</div>
		<a href="#" class="b-control-prev j-jcarousel_opinion-control-prev"></a>
		<a href="#" class="b-control-next j-jcarousel_opinion-control-next"></a>
	</div>
<?php endif; ?>