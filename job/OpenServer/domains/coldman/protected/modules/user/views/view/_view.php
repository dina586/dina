<div class="col-md-4">
	<div class="widget">
		<div class="widget-advanced widget-advanced-alt">
			<div class="widget-header text-left themed-background-dark-flatie">
				<?=UserHelper::getBackground($data->profile, 'thumbnail', ['class'=>'widget-background animation-pulseSlow'])?>
				<h3 class="widget-content widget-content-image widget-content-light clearfix">
					<?php 
						$this->widget('application.modules.user.widgets.AvatarWidget', 
							['model'=>$data->profile, 'type'=>'thumbnail', 'renderType'=>'link', 'linkOptions'=>['class'=>'pull-right b-avatar_preview_link']]
						);
					?>
					<a class="themed-color-default" href="<?=Yii::app()->createUrl('user/view/profile', ['id'=>$data->id])?>">
						<?=UserHelper::getName($data->profile); ?>
					</a>
					<br/>
				</h3>
			</div>
			<!--White field for extra data like links, profile information, etc.-->
			<!--<div class="widget-main"></div>-->
		</div>
	</div>
</div>