<div class="l-form">

<?php echo "<?php \$form=\$this->beginWidget('CActiveForm', array(
	'id'=>'b-'.Yii::app()->controller->module->id.'-form',
	'enableAjaxValidation'=>false,
)); ?>\n"; ?>

	<p class = "l-note"><?php echo "<?=Yii::t('admin', 'Fields with <span class=\"required\">*</span> are required')?>";?></p>

	<?php echo "<?php echo \$form->errorSummary(\$model); ?>\n"; ?>

<?php
foreach($this->tableSchema->columns as $column)
{
	if($column->autoIncrement)
		continue;
?>
	<div class="l-row">
		<?php echo "<?php echo ".$this->generateActiveField($this->modelClass,$column)."; ?>\n"; ?>
	</div>

<?php
}
?>
	<div class = "g-clear_fix"></div>
	
	<?php echo '<?=';?>Fields::submitBtn($model->isNewRecord ? Yii::t('admin','Create') : Yii::t('admin','Save'));?>

<?php echo "<?php \$this->endWidget(); ?>\n"; ?>

</div><!-- l-form -->