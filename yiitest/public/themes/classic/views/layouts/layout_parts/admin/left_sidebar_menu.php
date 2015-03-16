
    <?php
    $this->widget('bootstrap.widgets.TbMenu', array(
                                              'type'=>'list',
                                              'items' => array(
                                                  array(
                                                      'label'=>'Users',
                                                      'itemOptions'=>array('class'=>'nav-header'),
                                                      'icon'=>'icon-user'
                                                  ),
                                                  '',
                                                  array(
                                                      'label'=>'List',
                                                      'icon'=>' icon-list-alt',
                                                      'url'=>Yii::app()->createUrl('/user/admin/user/'),
                                                      'itemOptions'=>($this->action->id == 'index' && Yii::app()->controller->id == 'admin/user')?array('class'=>'active'):array(),

                                                  ),
                                                  array(
                                                      'label'=>'Create',
                                                      'icon'=>'icon-plus',
                                                      'url'=>Yii::app()->createUrl('/user/admin/user/create'),
                                                      'itemOptions'=>($this->action->id == 'create' && Yii::app()->controller->id == 'admin/user')?array('class'=>'active'):array(),
                                                  ),
                                                  array(
                                                      'label'=>'Pages',
                                                      'itemOptions'=>array('class'=>'nav-header'),
                                                      'icon'=>'icon-book'
                                                  ),
                                                  '',
                                                  array(
                                                      'label'=>'List',
                                                      'icon'=>' icon-list-alt',
                                                      'url'=>Yii::app()->createUrl('/page/admin/page/'),
                                                      'itemOptions'=>($this->action->id == 'index' && Yii::app()->controller->id == 'admin/page')?array('class'=>'active'):array(),

                                                  ),
                                                  array(
                                                      'label'=>'Create',
                                                      'icon'=>'icon-plus',
                                                      'url'=>Yii::app()->createUrl('/page/admin/page/create'),
                                                      'itemOptions'=>($this->action->id == 'create' && Yii::app()->controller->id == 'admin/page')?array('class'=>'active'):array(),
                                                  ),

                                                  array('label'=>'Settings', 'itemOptions'=>array('class'=>'nav-header')),
                                                  '',
                                                  array(
                                                      'label'=>'List',
                                                      'icon'=>' icon-list-alt',
                                                      'url'=>Yii::app()->createUrl('admin/settings'),
                                                      'itemOptions'=>($this->action->id == 'index' && Yii::app()->controller->id == 'admin/settings')?array('class'=>'active'):array(),

                                                  ),
                                              )
                                              ));
    ?>
