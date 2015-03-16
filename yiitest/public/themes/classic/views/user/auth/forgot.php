<?php
/** @var TbActiveForm $form */
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'type' => 'horizontal',
    'htmlOptions' => array('class' => 'well'),
));
?>
    <fieldset>
        <legend><?php echo "Password reset request" ?> </legend>
        <?php
        echo $form->textFieldRow($model, 'email', array());
        ?>
    </fieldset>
    <div class="form-actions">
        <?php
        $this->widget('bootstrap.widgets.TbButton', array(
                'buttonType' => 'submit',
                'type' => 'primary',
                'icon' => 'ok white',
                'label' => "Send request"
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