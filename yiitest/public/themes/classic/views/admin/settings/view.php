<div class="page-header">
    <h3>Settings</h3>
</div>
<?php

//$table = '$this->renderPartial("_settings_table",array("dataProvider"=>$dataProvider))';

$this->widget('bootstrap.widgets.TbTabs', array(
'type'=>'tabs', // 'tabs' or 'pills'
'tabs'=>array(
array('label'=>'General Settings', 'content'=>'General Settings', 'active'=>true),
array('label'=>'Advanced Settings', 'content'=>'Advanced Settings'),
array('label'=>'All Settings', 'content'=>$this->renderPartial('_settings_table',array('dataProvider'=>$dataProvider),true)),

)));
?>