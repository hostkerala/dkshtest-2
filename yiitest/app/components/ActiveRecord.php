<?php

/**
 * Base class for active records
 */
abstract class ActiveRecord extends CActiveRecord
{
	public function behaviors()
	{
		return array(
			'CTimestampBehavior' => array(
				'class' => 'zii.behaviors.CTimestampBehavior',
				'createAttribute' => 'createdAt',
				'updateAttribute' => 'updatedAt',
			)
		);
	}
}
