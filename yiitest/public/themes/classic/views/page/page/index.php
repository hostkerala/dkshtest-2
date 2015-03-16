<?php
$this->breadcrumbs = array(
    'Pages',
);

$this->widget('bootstrap.widgets.TbListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
));