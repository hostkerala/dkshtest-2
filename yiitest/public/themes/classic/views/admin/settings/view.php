<div class="page-header">
    <h3>Settings</h3>
</div>
<?php

//$table = '$this->renderPartial("_settings_table",array("dataProvider"=>$dataProvider))';

$this->widget('bootstrap.widgets.TbTabs', array(
'type'=>'tabs', // 'tabs' or 'pills'
'tabs'=>array(
array('label'=>'General Settings', 
                'content'=> '<div class="btn-group" role="group" aria-label="General Settings">
                                <a class="btn btn-primary btn-large" href='.yii::app()->createUrl('admin/contries').'>Contries Settings</a>
                                <a class="btn btn-warning btn-large" href='.yii::app()->createUrl('admin/states').'>States Settings</a>
                                <a class="btn btn-info btn-large" href='.yii::app()->createUrl('admin/zipareas').'>Cities Settings</a>
                             </div>', 
                                'active'=>true),
array('label'=>'Advanced Settings', 'content'=>'Advanced Settings'),
array('label'=>'All Settings', 'content'=>$this->renderPartial('_settings_table',array('dataProvider'=>$dataProvider),true)),

)));
?>