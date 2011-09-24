<?php include config_item('application_root') . 'views/email/includes/header.php'; ?>

<h1><?= config_item('company_name') ?> Password Recovery</h1>

Below is your username and password information. If you did not request
your password to be recovered, please ignore this.<br /><br/>

Site name: <b><?= $site_name ?></b><br />
Password: <b><?= $password ?></b>

<p>
Login at <a href="<?= config_item('base_url') ?>home/login"><?= config_item('base_url') ?>home/login</a>.
</p>

<?php include config_item('application_root') . 'views/email/includes/footer.php'; ?>