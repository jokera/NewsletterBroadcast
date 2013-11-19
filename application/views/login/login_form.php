<p><?= $this->session->flashdata('errmsg'); ?></p>
<div id="login">
    <fieldset>
        <legend>Login</legend>
        <?= form_open('login/validate'); ?>
        <?= form_input('username', set_value('username', 'Username')); ?>
        <?= form_password('password', set_value('password', 'Password')); ?>
        <?= form_submit('submit', 'Login'); ?>
        <?= form_close(); ?>
        <?= validation_errors('<p class="validation_err">'); ?> 

    </fieldset>
    <?= anchor('login/register', 'Registration'); ?>
</div>
