<?php 
	$path = Yii::getPathOfAlias('webroot').DS."upload".DS."service".DS.$model->id.".jpg";
	if(file_exists($path))
		$src = '<img src = "/upload/service/'.$model->id.'.jpg" title = "'.$model->name.'" alt = "'.$model->name.'" />';
	else
		$src = '';
		$src = '';
?>
<?php 
$this->widget('application.components.BreadCrumb', 
    array('crumbs' => array(
             array('name' => 'Услуги', 'url' => ''.Yii::app()->createUrl('/service').''),
			 array('name' => ''.$model->name.''),
    ) ));
?>
<div class="wrapper">
	<div class="container">        	
		<div class="content_block row no-sidebar single_post">
			<div class="fl-container">
				<div class="posts-block">
					<div class="contentarea">   
						<div class="blog_post_preview animate" data-anim-type="fadeInUp" data-anim-delay="300">
							<h1><?=$model->name;?></h1>   
							<div class="blog_post_image">
								<?=$src;?>
							</div>
							<div class="blog_content">
								<p><?=$model->content;?></p>
							</div>
						</div>                                                                             
														
					</div>
				</div>
			</div>
		</div>
	</div> 
</div>
<div class="clear"></div> 
<?=Helper::editLink(Yii::app()->createUrl(Yii::app()->controller->module->id.'/'.Yii::app()->controller->id.'/update', array('id'=>$model->id)));?>