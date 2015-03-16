<div class="navbar-inner">

    <?php
    Yii::import('application.modules.page.models.Page');

    $this->widget('bootstrap.widgets.TbNavbar', array(
            'type' => null, // null or 'inverse'
            'brand' => 'Frontend Area',
            'brandUrl' => Yii::app()->homeUrl,
            'collapse' => true, // requires bootstrap-responsive.css
            'items' => array(
             
                array(
                    'class' => 'bootstrap.widgets.TbMenu',
                    'items' => array(
                        array('label' => 'Admin panel',
                            'url' => Yii::app()->createUrl('/site/admin'),
                            'visible' => Yii::app()->user->isAdmin
                        ),
                        array('label' => 'Home',
                            'url' => Yii::app()->homeUrl
                        ),
                      
                    
                        array('label' => 'Login',
                            'url' => Yii::app()->createUrl('/user/auth/login'),
                            'visible' => Yii::app()->user->isGuest
                        ),
                        array('label' => 'Welcome ' . Yii::app()->user->name,
                            'url' => array('/user/auth/logout'),
                            'visible' => !Yii::app()->user->isGuest,
                            'items'=>array(
                                array(
                                    'label'=>'Profile',
                                    'url'=>Yii::app()->createUrl('user/user/settingsprofile')
                            ),
                                array(
                                    'label'=>'Logout',
                                    'url'=>Yii::app()->createUrl('user/auth/logout')
                                )
                            )
                        ),
                        array('label' => 'Register ',
                            'url' => array('/user/auth/register'),
                            'visible' => Yii::app()->user->isGuest
                        ),
                    ),
                ),
            ),
        )
    ); ?>
</div>