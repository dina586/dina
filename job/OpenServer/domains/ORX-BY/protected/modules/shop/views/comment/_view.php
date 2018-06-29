<?php 
$path = ROOT_PATH.DIRECTORY_SEPARATOR."upload".DIRECTORY_SEPARATOR."comment".DIRECTORY_SEPARATOR.$data->id.".jpg";
	if(file_exists($path)){
		$img = '<img src = "/upload/comment/'.$data->id.'.jpg">';
	} else {
		$img = '';
	}
$date = Yii::app()->dateFormatter->format('dd.MM.yy', $data->create_time);
	echo '<section class = "b-opinion_view b-stars_view">
		'.$img.'
		<article>
		<header>
			<time datetime="'.$data->create_time.'">'.$date.'</time>
				<span>'.CHtml::encode($data->user_name).'</span>
				<section class = "b-star_rating"';
		$this->widget('CStarRating', array(
			'name'=>'star_'.$data->id.'',
			'allowEmpty'=>false,
			'value'=>$data->star,
			'readOnly' => true,
			'callback' => 'function(value) {}'
		));
	echo '</section>
		</header>
			<p>
				'.CHtml::encode($data->comment).'
			</p>
		</article>
	</section>';
?>
<div class = "g-clear_fix"></div>