<?php 
$path = ROOT_PATH.DIRECTORY_SEPARATOR."upload".DIRECTORY_SEPARATOR."opinions".DIRECTORY_SEPARATOR.$data->id.".jpg";
	if(file_exists($path)){
		$img = '<img src = "../../upload/opinions/'.$data->id.'.jpg">';
	} else {
		$img = '';
	}
$date = Yii::app()->dateFormatter->format('dd.MM.yy', $data->date);
						echo '<section class = "b-opinion_view">
							'.$img.'
							<article>
								<span>'.$data->name.'</span>
								<p>
									'.$data->text.'
								</p>
							</article>
					</section>
					';
					?>
<div class = "g-clear_fix"></div>