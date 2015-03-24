<?php
/* @var $this StatesController */
/* @var $data States */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('state_code')); ?>:</b>
	<?php echo CHtml::encode($data->state_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('country_id')); ?>:</b>
	<?php echo CHtml::encode($data->country_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('state_name_en')); ?>:</b>
	<?php echo CHtml::encode($data->state_name_en); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('state_name_ru')); ?>:</b>
	<?php echo CHtml::encode($data->state_name_ru); ?>
	<br />


</div>