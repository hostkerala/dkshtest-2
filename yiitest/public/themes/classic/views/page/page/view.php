<?php
$this->breadcrumbs = array(
    'Pages' => array('index'),
    $model->title,
);

?>

<h1>View Page "<?php echo $model->title; ?>"</h1>

<div class="content">
    <?php echo $model->content; ?>
</div>
