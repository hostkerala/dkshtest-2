<!DOCTYPE html>
<html lang="en">
<head></head>
<body>
    
        <!-- Registering Bootstrap JS/CSS files -->    
        <?php Yii::app()->bootstrap->register(); ?>
        <!-- End Registering Bootstrap JS/CSS files -->    
        
        <!-- Header Menu -->
        <?php  $this->renderPartial('//layouts/layout_parts/admin/header_menu'); ?>
        <!-- End Header Menu -->

            <div class="container">

                <!-- Breadcrumbs -->
                <?php  $this->renderPartial('//layouts/layout_parts/admin/breadcrumbs'); ?>
                <!-- End Breadcrumbs -->

                <!-- Flash Messages -->
                <?php  $this->renderPartial('//layouts/layout_parts/admin/flash_messages'); ?>
                <!-- End Flash Messages-->
          
                <!-- Sidebar Menu -->
                    <div class="span2">
                        <?php   $this->widget('bootstrap.widgets.TbBox', array(
                                                                         'title' => 'Navigation',
                                                                         'headerIcon' => 'icon-th-list',
                                                                         'content' => $this->renderPartial('//layouts/layout_parts/admin/left_sidebar_menu','',true)
                                                                         )); ?>

                    </div>
                <!-- End Sidebar Menu -->
                <!-- Main Content Area -->
                    <div class="span9  ">
                     <?php   $this->widget('bootstrap.widgets.TbBox', array(
                        'title' => 'Admin Panel',
                        'headerIcon' => 'icon-plane',
                        'content' => $content
                        )); ?>
                    </div>
                <!-- End Main Content Area -->
             
            </div>


<div class="navbar-fixed-bottom row-fluid ">
    <div class="navbar-inner">
        <div class="container-fluid">
            <p class="pull-right">
            Powered by <a target="_blank" href="http://www.yiiframework.com">
                <img src="http://static.yiiframework.com/files/logo/yii-bw.png" title="Yii logo in black and white" width="110" alt="">
            </a>
            </p>
            </div>


</div>
</div>
</body>
</html>
