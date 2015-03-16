<div class="page-header">
    <h3>Pages</h3>
</div>
<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'type'=>'striped',
    'dataProvider'=>$dataProvider,
    'columns'=>$gridColumns
));?>
