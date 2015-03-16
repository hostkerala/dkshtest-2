<legend>Profile Settings</legend>
<div class="row-fluid">
    <div class="span10">
        <?php
        $this->widget('bootstrap.widgets.TbBox', array(
            'title' => 'Information',
            'headerIcon' => 'icon-wrench',
            'content' => $this->renderPartial('_profile_contact_info', array('userModel' => $userModel, 'changePasswordModel' => $changePasswordModel), true)
        ));
        ?>
    </div>
</div>