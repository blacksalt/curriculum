<?php echo link_tag('public/css/forms.css'); ?>

<?php echo validation_errors(); ?>

<?php echo form_open('gate/auth') ?>
    <fieldset>
        <legend> Log in </legend>
	    <label for="username">Username:</label> <?php echo form_input(array('name' => 'username','value' => set_value('username'))) ?> <br />
        <label for="password">Password:</label> <?php echo form_password(array('name' => 'password')) ?> <br />
	    <label for="login">&nbsp;</label><?php echo form_submit('login', 'Login') ?> <br />
	</fieldset>
<?php echo form_close() ?>
