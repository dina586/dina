<div class = "b-upload_avatar">
	
	<div class = "block full clearfix">
		<div class="block-title">
			<h2><strong>1. <?=Yii::t('admin', 'Upload Your Avatar');?></strong></h2>
		</div>
		<div class = "block-content">
			<p><?=Yii::t('admin', 'You can upload the image in JPG, GIF, or PNG.')?></p>
			<?php
			$this->widget('file_uploader.UploadWidget', array(
				'multiple'=>false,
				'uploadButtonText'=>Yii::t('admin', 'Click here to upload new avatar'),
				'dragText'=>Yii::t('admin', 'Drop image here to upload'),
				'action'=>Yii::app()->createUrl('user/assist/avatar'),
				'onComplete'=>'js:function(id, fileName, responseJSON){crop_avatar(id, fileName, responseJSON)}',
				'onError'=>'js:function(id, fileName, responseJSON){error_avatar_upload(id, fileName, responseJSON)}',
				'postParams' => [
					'file_type' => 'image',
				],
			));
			?>
			
		</div>
	</div>
	
	<div class = "block full clearfix l-hidden" id = "j-avatar_block">
		<div class="block-title">
			<h2><strong>2. <?=Yii::t('admin', 'Image on your profile page');?></strong></h2>
		</div>
		<div class = "block-content">
			<div id = "j-avatar_success_upload" class = "l-hidden">
				<p><?=Yii::t('admin', 'The selected area will be displayed on your page.');?></p>

				<div class = "b-upload_avatar_original" id = "j-avatar_img_container"></div>

				<div class = "clearfix"></div>

				<div class = "b-upload_avatar_form">
					<form action = "<?=Yii::app()->createUrl($this->route)?>" method ="post">
						<?=BsHtml::hiddenField('ImgSize[custom_width]', '', ['class'=>'j-img_size_custom_width'])?>
						<?=BsHtml::hiddenField('ImgSize[custom_height]', '', ['class'=>'j-img_size_custom_height'])?>
						<?=BsHtml::hiddenField('ImgSize[x]', '', ['class'=>'j-img_size_x'])?>
						<?=BsHtml::hiddenField('ImgSize[y]', '', ['class'=>'j-img_size_y'])?>
						<?=BsHtml::hiddenField('ImgSize[w]', '', ['class'=>'j-img_size_w'])?>
						<?=BsHtml::hiddenField('ImgSize[h]', '', ['class'=>'j-img_size_h'])?>
						<?=BsHtml::hiddenField('ImgSize[img_name]', '', ['class'=>'j-img_size_name'])?>
						<button class = "btn btn-lg btn-success"><?=Yii::t('admin', 'Save and continue')?></button>
						<a class = "btn btn-lg btn-info" href = "<?=UserHelper::link('user/view/profile')?>"><?=Yii::t('main', 'Cancel and back')?></a>
					</form>
				</div>
			</div>
			
			<div id = "j-avatar_error_upload" class = "l-hidden">
				<div class="alert alert-danger">
					<h4><i class="fa fa-times-circle"></i> Error</h4> 
					<p></p>
				</div>
			</div>
		</div>
	</div>
</div>
