<?php
/** @var TbActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'type' => 'horizontal',
    'htmlOptions' => array(
        'class' => 'well',
    ),
));
?>
    <fieldset>
        <legend><?php echo  "Change Password";?> </legend>

        <?php echo $form->passwordFieldRow($model, 'password', array());?>

        <?php echo $form->passwordFieldRow($model, 'confirmPassword', array());?>

    </fieldset>
    <div class="form-actions">
        <?php
        $this->widget('bootstrap.widgets.TbButton', array(
                'buttonType' => 'submit',
                'type' => 'primary',
                'icon' => 'ok white',
                'label' => "Change Password",
                'htmlOptions' => array(
                    'disabled' => false,
                    'id' => 'submit'
                )
            )
        );
        ?>
        <?php
        $this->widget('bootstrap.widgets.TbButton', array(
                'buttonType' => 'reset',
                'icon' => 'remove',
                'label' => "Clear"
            )
        );
        ?>
    </div>
<?php $this->endWidget(); ?>