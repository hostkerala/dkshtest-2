
<div class="page-header">
    <h3>View User #<?php echo $model->id; ?></h3>
</div>
<?php

$this->widget('bootstrap.widgets.TbDetailView',array(
'data'=>$model,
'attributes'=>array(
		'id',
		'username',
		'email',
		'city_id'=>array('name'=>'city','value'=>$model->city?$model->city->city:null),
		'state_id',
		'created_at',
		'updated_at',
),
)); ?>
