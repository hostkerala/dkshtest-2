<br/>
<?php
$this->widget('bootstrap.widgets.TbButton', array(
    'label' => 'Users',
    'type' => 'primary',
    'size' => 'large',
    'url' => Yii::app()->createUrl('site/users'),
    'htmlOptions' => array('style' => 'margin-right: 10px;'),
));
?>
<?php
$this->widget('bootstrap.widgets.TbButton', array(
    'label' => 'Topics',
    'url' => Yii::app()->createUrl('topic/index'),
    'size' => 'large',
));
?>
<br/>
<br/>