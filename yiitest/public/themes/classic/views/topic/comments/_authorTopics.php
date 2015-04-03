<div class="span3" style="margin:0px;">
<?php
$this->widget('bootstrap.widgets.TbGridView', array(
    'type' => 'striped bordered condensed',
    'id' => 'topic-grid',
    'afterAjaxUpdate' => 'reinstallDatePickerAndAllDropDown',
    'hideHeader'=>true,
    'summaryText'=>false,
    
    'dataProvider' => $authorTopics,
    'columns' => array(
        array(
            'name'=>'title',
            'type'=>'raw',
            'value' => 'CHtml::link($data->title,Yii::app()->createUrl("topic/view",array("id"=>$data->id)))',
      ),
    ),
));
?>
</div>
<style>
.grid-view table.items tbody tr td:hover
{
    background: #CCFF66;
}
.grid-view table.items tbody tr td a
{
    text-decoration:none;
}
</style>


