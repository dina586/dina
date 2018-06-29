<?php
if (count($dataProvider) > 0):
	?>
	<div class = "b-jcarousel_wrap b-slider_carousel">
		<div class = "l-jcarousel j-jcarousel_slider">
			<ul>
				<?php foreach ($dataProvider as $data) { 
						$path = Yii::getPathOfAlias('webroot').DS."upload".DS.Yii::app()->getModule('slider')->folder.DS.$data->img_name;
							if(file_exists($path))
								$img = '<img src = "/upload/'.Yii::app()->getModule('slider')->folder.'/'.$data->img_name.'" title = "'.$data->name.'" alt = "'.$data->name.'" />';
							else
								continue;
					?>
					<li>
						<?=$img?>
					</li>
				<?php } ?> 
			</ul>
		</div>
		<a href="#" class="b-control-prev j-jcarousel_opinion-control-prev"></a>
		<a href="#" class="b-control-next j-jcarousel_opinion-control-next"></a>
	</div>
<?php endif; ?>