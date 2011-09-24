<?php include config_item('application_root') . 'views/email/includes/header.php'; ?>

<h1>Welcome to <?= config_item('company_name') ?>!</h1>

Below is your username and password information.<br /><br/>

Site name: <b><?= $site_name ?></b><br />
Password: <b><?= $password ?></b>

<p>
Login at <a href="<?= config_item('base_url') ?>home/login"><?= config_item('base_url') ?>home/login</a>! 
You can also view your website at <a href="<?= config_item('base_url') ?><?= $site_name ?>"><?= config_item('base_url') ?><?= $site_name ?></a>
</p>

<?php include config_item('application_root') . 'views/email/includes/footer.php'; ?>