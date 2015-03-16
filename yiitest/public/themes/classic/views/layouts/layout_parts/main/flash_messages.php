<?php
$this->widget('bootstrap.widgets.TbAlert', array(
	'block'=>true, // display a larger alert block?
	'fade'=>true, // use transitions?
	'closeText'=>'&#215;', // close link text - if set to false, no close link is displayed
	'alerts'=>array( // configurations per alert type
		'success'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&#215;'), // success, info, warning, error or danger
		'error'=>array('block'=>true, 'fade'=>true, 'closeText'=>'&#215;'), // success, info, warning, error or danger
	),
));

