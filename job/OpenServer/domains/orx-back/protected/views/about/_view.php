<?php $date = Yii::app()->dateFormatter->format('dd.MM.yy', $data->date);
$url = Yii::app()->createUrl('about/view', array('id'=>$data->id));
$imgLink = '';
if(file_exists(ROOT_PATH."/upload/about/thumbnails/".$data->id.".jpg")) {
	$imgLink = '<a href = "'.$url.'"><img src = "/upload/about/thumbnails/'.$data->id.'.jpg"></a>';
}

						echo '<section class = "b-opinion_view">
							'.$imgLink.'
							<article>
								
								<a class = "about_link" href = "'.$url.'">'.$data->name.'</a>
								<p>
									'.$data->brief_descr.'
								</p>
							</article>
					</section>
					';
					?>
<div class = "g-clear_fix"></div>