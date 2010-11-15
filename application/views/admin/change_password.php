<?php echo link_tag('public/css/forms.css'); ?>

<?php echo validation_errors(); ?>

<?php echo form_open('admin/change_password') ?>
    <fieldset>
        <legend> Change Password </legend>
	    <label for="current"> Current Password:</label> <?php echo form_password(array('name' => 'current')) ?> <br />
        <label for="new"> New Password:</label> <?php echo form_password(array('name' => 'new')) ?> <br />
        <label for="confirm"> Confirm Password:</label> <?php echo form_password(array('name' => 'confirm')) ?> <br />
	    <label for="change">&nbsp;</label><?php echo form_submit('change', 'Change Password') ?> <br />
	</fieldset>
<?php echo form_close() ?>
