<?php
/* @var $this BlocksController */
/* @var $data Blocks */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('content')); ?>:</b>
	<?php echo CHtml::encode($data->content); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('position')); ?>:</b>
	<?php echo CHtml::encode($data->position); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('page_position')); ?>:</b>
	<?php echo CHtml::encode($data->page_position); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('is_view')); ?>:</b>
	<?php echo CHtml::encode($data->is_view); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('view_title')); ?>:</b>
	<?php echo CHtml::encode($data->view_title); ?>
	<br />

	*/ ?>

</div>