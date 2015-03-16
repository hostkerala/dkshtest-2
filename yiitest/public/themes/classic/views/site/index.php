<div class="container" >
    <?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
	'title' => 'Advanced Box',
	'headerIcon' => 'icon-th-list',
	// when displaying a table, if we include bootstra-widget-table class
	// the table will be 0-padding to the box
	'htmlOptions' => array('class'=>'bootstrap-widget-table')
));?>
    <br/>
    <?php
    $this->widget('bootstrap.widgets.TbButton', array(
        'label' => 'Users',
        'type' => 'primary',
        'size' => 'large',
        'url' => Yii::app()->createUrl('site/users')
    ));
    ?>
      <?php
    $this->widget('bootstrap.widgets.TbButton', array(
        'label' => 'Topics',
        'url' => Yii::app()->createUrl('topic/index'),
        'size' => 'large'
    ));
    ?>
    <br/><br/>
    
    
    <?php $this->endWidget();?>
</div>