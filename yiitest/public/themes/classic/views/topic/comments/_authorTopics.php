<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'type' => 'striped bordered condensed',
    'id' => 'topic-grid',
    'afterAjaxUpdate' => 'reinstallDatePickerAndAllDropDown',
    'dataProvider' => $authorTopics,
    'columns' => array(
        'title',
        array(
            'htmlOptions' => array('nowrap' => 'nowrap'),
            'class' => 'bootstrap.widgets.TbButtonColumn',
            'template' => '{view}'
        )
    ),
));
?>




