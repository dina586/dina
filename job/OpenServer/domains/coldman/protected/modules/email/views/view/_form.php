<div class="l-form">

<?php $form=$this->beginWidget('bootstrap.widgets.BsActiveForm', array(
	'id'=>'b-'.Yii::app()->controller->module->id.'-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array(
		'class'=>'j-email_form',
	),
)); ?>
	<div class="block full">
		<?php echo $form->errorSummary($model); ?>

		<?php if(!Yii::app()->user->checkAccess("developer")) {
			$model->name = Yii::t("admin", $model->name);
			$model->subject = Yii::t("admin", $model->subject);
			$model->success_message = Yii::t("admin", $model->success_message);
			$model->failed_message = Yii::t("admin", $model->failed_message);
		}
		?>

		<div class="l-row">
			<?php echo $form->textFieldControlGroup($model,'subject'); ?>
			<p class = "l-hint"><?=Yii::t('admin', 'In the email message header, you can also use tags');?></p>
		</div>

		<div class="l-row">
			<?=Fields::editor($model, $form, 'message'); ?>
		</div>

		<div class = "g-clear_fix"></div>

		<?php if(!$model->isNewRecord):?>
			<div class = "l-row">
				<?php echo Helper::linkButton(Yii::t('admin', 'Send test message'), 
					Yii::app()->createUrl('email/view/sendTest', array('id'=>$model->id)),
					array(
						'color' => BsHtml::BUTTON_COLOR_PRIMARY,
						'size' => BsHtml::BUTTON_SIZE_SMALL,
						'icon' => BsHtml::GLYPHICON_ENVELOPE,
						'class' => 'a-send_test_email',
					)
				);?>

				<div class = "l-system_message d-send_test_email b-email_message_request"></div>

				<p class = "l-hint">
					<?=Yii::t('admin', 'Email message will be sent to test email:');?> <?=Settings::getVal('test_email')?>. 
					<a target = "_blank" href = "<?=Yii::app()->createUrl('settings/settings/update', array('id'=>8))?>"><?=Yii::t('admin', 'Edit email')?></a>
				</p>
			</div>
		<?php endif;?>

		<div class = "g-clear_fix"></div>

		<div class="l-row">
			<?php echo $form->textFieldControlGroup($model,'name'); ?>
			<p class = "l-hint"><?=Yii::t('admin', 'This field is only used for navigation. Only admins can see this field.');?></p>
		</div>

		<div class="l-row">
			<?php echo $form->textFieldControlGroup($model,'success_message'); ?>
			<p class = "l-hint"><?=Yii::t('admin', 'View message when email is sent successfully. If the field is empty, it will display the default value. You can edit signature');?>
			<a target = "_blank" href = "<?=Yii::app()->createUrl('settings/settings/update', array('id'=>11))?>"><?=Yii::t('admin', 'here')?></a>
			</p>
		</div>

		<div class="l-row">
			<?php echo $form->textFieldControlGroup($model,'failed_message'); ?>
			<p class = "l-hint">
				<?=Yii::t('admin', 'View message when email did not send. If the field is empty, it will display the default value. You can edit signature');?>
				<a target = "_blank" href = "<?=Yii::app()->createUrl('settings/settings/update', array('id'=>12))?>"><?=Yii::t('admin', 'here')?></a>
	s		</p>
		</div>

		<div class="l-row l-checkbox">
			<?php echo $form->checkboxControlGroup($model,'header'); ?>
			<p class = "l-hint">
				<?=Yii::t('admin', 'This email message will use general header. You can edit header')?> 
				<a target = "_blank" href = "<?=Yii::app()->createUrl('settings/settings/update', array('id'=>4))?>"><?=Yii::t('admin', 'here')?></a>
			</p>
		</div>

		<div class="l-row l-checkbox">
			<?php echo $form->checkboxControlGroup($model,'footer'); ?>
			<p class = "l-hint">
				<?=Yii::t('admin', 'This email message will use general signature. You can edit signature')?> 
				<a target = "_blank" href = "<?=Yii::app()->createUrl('settings/settings/update', array('id'=>5))?>"><?=Yii::t('admin', 'here')?></a>
			</p>
		</div>

		<?php if(Yii::app()->user->checkAccess("developer")):?>

			<div class="l-row">
				<?php echo $form->textFieldControlGroup($model,'email_key'); ?>
			</div>

			<div class="l-row">
				<?php echo $form->dropDownListControlGroup($model,'email_type', $this->module->emailFor); ?>
			</div>

			<div class="l-row">
				<?php echo $form->textAreaControlGroup($model,'comment'); ?>
			</div>

			<div class="l-row b-email_tags_wrap">
				<h2><?=Yii::t('admin', 'Email Tags');?></h2>
				<div class ="row">
					<?=EmailHelper::generateTagsDeveloper($model->id);?>
				</div>
			</div>
		<?php else: ?>
			<div class="l-row">
				<p class = "l-hint"><?=Yii::t("admin", $model->comment); ?></p>
			</div>


			<div class = "l-row b-email_tags_wrap">
				<h2><?=Yii::t('admin', 'Email Tags');?></h2>
				<p class = "l-hint"><?=Yii::t('admin', 'When forming the letters can use tags described below. To correctly display the data from the website, it is recommended to use all tags.');?></p>		
				<?=EmailHelper::generateTagsAdmin($model->id);?>
			</div>
		<?php endif;?>

		<div class = "clearfix"></div>
	
		<?=Fields::submitBtn($model->isNewRecord ? Yii::t('admin','Create') : Yii::t('admin','Save'));?>
	</div>
<?php $this->endWidget(); ?>

</div><!-- l-form -->

<?php
JS::add('send_email', "$(document).ready(function() {
	$(document).on('click', '.a-send_test_email', function() {
		var url = $(this).attr('href');
		var options = { 
			beforeSubmit: function() {
				$('.d-send_test_email').html('<img src = \"/images/system/page_preloader.gif\"/>');
			},
			success: function(data) {
				$('.d-send_test_email').html(data).addClass('alert alert-success');;
			}, 
			error: function(data) {
				$('.d-send_test_email').html(data).addClass('alert alert-danger');
			},
			url : url
		}; 
		$('.j-email_form').ajaxSubmit(options);
		return false;
	})
})");
?>
