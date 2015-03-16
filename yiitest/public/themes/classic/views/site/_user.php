<?php

$this->widget('bootstrap.widgets.TbDetailView',array(
                                               'data'=>$data,
                                               'type'=>array('condensed','bordered'),
                                               'attributes'=>array(
                                                   'username',
                                                   'city_id'=>array('name'=>'city','value'=>$data->city?$data->city->city:null),
                                                   'state_id',
                                                   'skills'=>array('name'=>'Skills', 'value' => $data->userSkillsString?$data->userSkillsString: null)
                                               ),
                                               )); ?>