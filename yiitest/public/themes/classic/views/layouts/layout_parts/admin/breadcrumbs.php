<?php
$this->widget('bootstrap.widgets.TbBreadcrumbs', array(
                                                 'homeLink'=>CHtml::link('Home',array('/site/admin')),
                                                 'links'=>$this->breadcrumbs,
                                                 'htmlOptions' => array('class'=>'navbar-inverse')
                                                 ));

