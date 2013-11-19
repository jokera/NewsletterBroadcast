<style type="text/css">
    p.validation_err{
        color:red;
        font: bold 13px;
        margin: 1px 0 6px;

    }
    fieldset{
        width: 300px;
        margin: 0 auto;
        padding: 0 50px;
        background-color: #eee;
    }
    input{
        width: 250px;
        padding: 5px 2px;
        font-size: 14px;
    }
</style>
<?php
$username = array(
    'name' => 'username',
    'id' => 'username',
    'value' => set_value('username')
);

$password = array(
    'name' => 'password',
    'id' => 'password'
);

$password2 = array(
    'name' => 'password2',
    'id' => 'password2'
);
$email = array(
    'name' => 'email',
    'id' => 'email',
    'value' => set_value('email')
);

$fname = array(
    'name' => 'fname',
    'id' => 'fname',
    'value' => set_value('fname')
);
$lname = array(
    'name' => 'lname',
    'id' => 'lname',
    'value' => set_value('lname')
);
?>
<?= form_open('login/validate_register'); ?>
<?= form_fieldset('Register new user'); ?>

<dl>
    <dt><?= form_label('Username', $username['name']); ?></dt>
    <dd>
        <?= form_input($username); ?>
        <?= form_error($username['name']); ?>
    </dd>

    <dt><?= form_label('Password', $password['name']); ?></dt>
    <dd>
        <?= form_password($password); ?>
        <?= form_error($password['name']); ?>
    </dd>

    <dt><?= form_label('Confirm Password', $password2['name']); ?></dt>
    <dd>
        <?= form_password($password2); ?>
        <?= form_error($password2['name']); ?>
    </dd>

    <dt><?= form_label('E-mail Address', $email['name']); ?></dt>
    <dd>
        <?= form_input($email); ?>
        <?= form_error($email['name']); ?>
    </dd>

    <dt><?= form_label('First Name', $fname['name']); ?></dt>
    <dd>
        <?= form_input($fname); ?>
        <?= form_error($fname['name']); ?>
    </dd>

    <dt><?= form_label('Last Name', $lname['name']); ?></dt>
    <dd>
        <?= form_input($lname); ?>
        <?= form_error($lname['name']); ?>
    </dd>
    <dt></dt>
    <dd><?= form_submit('register', 'Create account'); ?>

    </dd>
    <?= form_fieldset_close(); ?>
</dl>

<?=
form_close();


