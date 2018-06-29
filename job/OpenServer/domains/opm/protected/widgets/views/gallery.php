<?php
if(count($dataprovider)>0):
	echo '<ul class = "b-gallery_images_view j-swipebox a">';

	foreach($dataprovider as $data):
	
	$file = Yii::getPathOfAlias('webroot').DS.'upload'.DS.Yii::app()->getModule('file')->uploadFolder.DS.$data->folder.DS.$this->type.DS;
	
	if(Yii::app()->cFile->set($file.$data->file)->exists)
		$img = Helper::loadImage(
			'/upload/'.Yii::app()->getModule('file')->uploadFolder.'/'.$data->folder.'/'.$this->type.'/'.$data->file,
			'/upload/'.Yii::app()->getModule('file')->uploadFolder.'/'.$data->folder.'/original/'.$data->file,
			strip_tags($data->description)
		);
		
	else
		continue;
	?>
	<li class = "l-inline_block">
		<?=$img;?>
		<?php if($this->description){?>
			<p><?=$data->description?></p>
		<?php }?>
	</li>
	<?php endforeach;	
	echo '</ul>';
	?>

<script type="text/javascript">


	$( '.j-swipebox a' ).swipebox( {
		useCSS : true, // false will force the use of jQuery for animations
		useSVG : true, // false to force the use of png for buttons
		initialIndexOnArray : 0, // which image index to init when a array is passed
		hideCloseButtonOnMobile : false, // true will hide the close button on mobile devices
		hideBarsDelay : 3000, // delay before hiding bars on desktop
		videoMaxWidth : 1140, // videos max width
		beforeOpen: function() {}, // called before opening
		afterOpen: null, // called after opening
		afterClose: function() {}, // called after closing
		loopAtEnd: false // true will return to the first image after the last image is reached
	} );
	$(document).ready(function() {

	$(".j-lazy").lazy({
		effect: "fadeIn", 
		effectTime: 1000
	});
	})

</script>
<?php
endif;
?>