<?php
/**
 * This is the template for generating a form script file.
 * The following variables are available in this template:
 * - $this: the FormCode object
 */
?>
<?php echo "<?php\n"; ?>
/* @var $this <?php echo $this->getModelClass(); ?>Controller */
/* @var $model <?php echo $this->getModelClass(); ?> */
/* @var $form CActiveForm */
?>

<div class = "l-form">

<?php echo "<?php \$form=\$this->beginWidget('CActiveForm', array(
	'id'=>'".$this->class2id($this->modelClass).'-'.basename($this->viewName)."-form',
	'enableAjaxValidation'=>false,
)); ?>\n"; ?>

	<div class="block full">

	<?php echo "<?php echo \$form->errorSummary(\$model); ?>\n"; ?>

<?php foreach($this->getModelAttributes() as $attribute): ?>
	<div class="l-row">
		<?php echo "<?php echo \$form->textFieldControlGroup(\$model,'$attribute'); ?>\n"; ?>
	</div>

<?php endforeach; ?>

		<?php echo "<?=Fields::submitBtn(\$model->isNewRecord ? Yii::t('admin', 'Create') : Yii::t('admin', 'Save')); ?>"?>
	</div>

<?php echo "<?php \$this->endWidget(); ?>\n"; ?>

</div><!-- form -->