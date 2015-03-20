
<!DOCTYPE html>
<html lang="en">
<head></head>
<body>

<!-- Registering Bootstrap JS/CSS files -->    
<?php Yii::app()->bootstrap->register(); ?>
<!-- End Registering Bootstrap JS/CSS files --> 
    
<!-- Header Menu -->
<?php  $this->renderPartial('//layouts/layout_parts/main/header_menu'); ?>
<!-- End Header Menu -->

<div class="container">

    <!-- Breadcrumbs -->
    <?php  $this->renderPartial('//layouts/layout_parts/main/breadcrumbs'); ?>
    <!-- End Breadcrumbs -->

    <!-- Flash Messages -->
    <?php  $this->renderPartial('//layouts/layout_parts/main/flash_messages'); ?>
    <!-- End Flash Messages-->

    <!-- Main Content Area -->


        <?php echo $content ?>


    <!-- End Main Content Area -->
</div>


<footer class="navbar-bottom">
    <div class="container">
        <p class="powered">
            Powered by <a target="_blank" href="#">TEST</a> &copy;. All rights reserved.
    </div>
</footer>

</body>
</html>


