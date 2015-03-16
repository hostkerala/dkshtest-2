<?php
$this->breadcrumbs = array(
    'Pages' => array('index'),
    $model->title,
);

$this->menu = array(
    array('label' => 'List Page', 'url' => array('index')),
    array('label' => 'Create Page', 'url' => array('create')),
    array('label' => 'Update Page', 'url' => array('update', 'id' => $model->id)),
    array('label' => 'Delete Page', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
    array('label' => 'Manage Page', 'url' => array('admin')),
);
?>

<h1>View Page #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',
    array(
        'data' => $model,
        'attributes' => array(
            'id',
            'title',
            array(
                'name' => 'content',
                'value' => strip_tags($model->content)
            ),
            array(
                'name' => 'status',
                'value' => $model->getStatus()
            ),
            'slug',
        ),
    )
); ?>
