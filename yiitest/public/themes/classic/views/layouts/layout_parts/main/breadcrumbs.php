<?php
$this->widget('bootstrap.widgets.TbBreadcrumbs', array(
                                                 'homeLink'=>CHtml::link('Home',Yii::app()->homeUrl),
                                                 'links'=>$this->breadcrumbs,
                                                 ));

