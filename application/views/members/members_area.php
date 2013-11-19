<p>Hello, <b><?= $this->session->userdata('username'); ?></b></p>
<?= anchor('login/logout', 'Logout'); ?>