<div class="navbar-inner">

    <?php
    $this->widget('bootstrap.widgets.TbNavbar', array(
        'type' => 'inverse', // null or 'inverse'
        'brand' => 'Admin Area',
        'brandUrl' => Yii::app()->createUrl('site/admin'),
        'collapse' => true, // requires bootstrap-responsive.css
        'items' => array(
            array(
                'class' => 'bootstrap.widgets.TbMenu',
                'items' => array(
                    array('label' => 'Actions',

                        'items' => array(
                            array(
                                'label' => 'Users',
                                'icon' => 'user',
                                'items' => array(
                                    array(
                                        'icon' => 'list-alt',
                                        'label' => 'List',
                                        'url' => Yii::app()->createUrl('user/admin/user')
                                    ),
                                    array(
                                        'icon' => 'plus',
                                        'label' => 'Create',
                                        'url' => Yii::app()->createUrl('user/admin/user/create')
                                    ),
                                )
                            ),
                            array(
                                'label' => 'Pages',
                                'icon' => 'book',
                                'items' => array(
                                    array(
                                        'icon' => 'list-alt',
                                        'label' => 'List',
                                        'url' => Yii::app()->createUrl('page/admin/page')
                                    ),
                                    array(
                                        'icon' => 'plus',
                                        'label' => 'Create',
                                        'url' => Yii::app()->createUrl('page/admin/page/create')
                                    ),
                                )
                            ),
                            array(
                                'label' => 'Settings',
                                'icon' => 'wrench',
                                'url' => Yii::app()->createUrl('admin/settings')
                            )

                        )
                    ),

                ),
            ),

            array(
                'class' => 'bootstrap.widgets.TbMenu',
                'htmlOptions' => array('class' => 'pull-right'),
                'items' => array(
                    array('label' => Yii::app()->user->name, 'url' => '#', 'items' => array(
                        array('icon' => 'home', 'label' => 'Back to site', 'url' => '/'),
                        array('icon' => 'off', 'label' => 'Logout', 'url' => Yii::app()->createUrl('user/auth/logout')),
                    )),
                ),
            ),
        ),
    )); ?>
</div>