<?php
$this->breadcrumbs = array(
    'Contents' => array('index'),
    'Manage',
);

$this->menu = array(
    array('label' => 'List Content', 'url' => array('index')),
    array('label' => 'Create Content', 'url' => array('create')),
);

?>

<h1>Manage Contents</h1>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
    'id' => 'content-grid',
    'dataProvider' => $model->search(),
//    'filter' => $model,
    'columns' => array(
        'id',
        'created_at',
        'updated_at',
        'user_id',
        'title',
        'content',
        'type',
        'status',
/*        'slug',
        'thumbnail',*/
        array(
            'class' => 'bootstrap.widgets.TbButtonColumn',
        ),
    ),
)); ?>
