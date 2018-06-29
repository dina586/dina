<?php 
if(count($dataProvider)>0):
?>
	<div class = "hidden-xs flexslider b-front_slider j-flex_slider">
		<!-- Place somewhere in the <body> of your page -->
		<ul class="slides">
			<?php foreach($dataProvider as $data) { 
				?>
				<li>
					<img src = "/upload/<?=Yii::app()->getModule('slider')->frontFolder;?>/<?=$data->id;?>.jpg" alt = "<?=$data->name;?>" title = "<?=$data->name;?>"/>
				</li>

			<?php }?>
			</ul>
		</div>

<script type = "text/javascript">
$(window).load(function() {
	$('.j-flex_slider').flexslider({
		animation: "slide",
		directionNav: false,
	});
});
</script>
<?php 

endif;
?>