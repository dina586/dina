<?php $this->seo($model->seo_title, $model->seo_keywords, $model->seo_description, $model->name); ?>

<?php $this->widget('application.modules.slider.widgets.FrontSliderWidget') ?>


<div class = "b-front_appointment border_box">
	<div class="col-md-4">
		<h4 class="icon_tetle">
			<span class="appointment_icon l-inline_block"><span class = "fa-medkit"></span></span>
			<a href ="<?=Yii::app()->createURl('service/view/index');?>" class = "appointment_content l-inline_block">Services & Pricing & Gallery</a>
		</h4>
	</div>
	
	<div class="col-md-4">
		<h4 class="icon_tetle">
			<span class="appointment_icon l-inline_block"><span class = "fa-user-md"></span></span>
			<a href ="<?=Helper::getPageLink(8);?>" class = "appointment_content l-inline_block">OPM Training</a>
		</h4>
	</div>
	
	<div class="col-md-4">
		<h4 class="icon_tetle">
			<span class="appointment_icon l-inline_block"><span class = "fa-hospital-o"></span></span>
			<a href ="<?=Yii::app()->createURl('calendar');?>" class = "appointment_content l-inline_block">
				Schedule An Appointment Today!
			</a>
		</h4>
	</div>
</div>

<div class = "b-front_content">
	<div class = "row">
	<div class = "col-md-8">
		<article class = "g-styles">
			<h1 class = "l-page_title">
				<?=$model->name?>
			</h1>
			<?=$model->content;?>
		</article>
		
		<div class = "g-clear_fix"></div>
		
		<?=Helper::editLink(Yii::app()->createUrl('/page/view/update', array('id'=>$model->id)));?>	
		
		<div class = "g-clear_fix"></div>
	</div>
	
	
	
	<div class = "b-front_right col-md-4">
		
		<div class = "col-xs-12 col-sm-6 col-md-12">
			<h1 class = "l-page_title">About OPM</h1>
			<div class = "border_box">
				<a href = "http://th.365-solutions.com/page/view/video-workshop"><img src = "/upload/files/front_img1.png" alt = "About OPM"/></a>	
			</div>
		</div>
		
		<div class = "col-xs-12 col-sm-6 col-md-12">
			<h1 class = "l-page_title">OPM Training Courses</h1>
			<div class = "">
				<a href = "<?=Helper::getPageUrl(4);?>"><img src = "/upload/files/front_img2.png" alt = "OPM Training Courses"/></a>	
			</div>
		</div>
		
		<div class = "col-xs-12 col-sm-6 col-md-12">
			<h1 class = "l-page_title">Testimonials</h1>
			<div class="testimonial_box">
				<p>
					Lorine is a real perfectionist, and knows what she is doing. Permanent makeup to her is an art, and I have to say I am very pleased with the results. I had some permanent make-up done years ago on my upper eyelids…
				</p>
			</div>
		</div>
		
	</div>
	</div>
</div>


