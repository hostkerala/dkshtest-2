<?php
/* @var $this ContriesController */
/* @var $data Contries */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('country_iso_2')); ?>:</b>
	<?php echo CHtml::encode($data->country_iso_2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('country_iso_3')); ?>:</b>
	<?php echo CHtml::encode($data->country_iso_3); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('country_name_en')); ?>:</b>
	<?php echo CHtml::encode($data->country_name_en); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('country_name_ru')); ?>:</b>
	<?php echo CHtml::encode($data->country_name_ru); ?>
	<br />


</div>